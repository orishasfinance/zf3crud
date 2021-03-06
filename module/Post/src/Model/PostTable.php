<?php
namespace Post\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class PostTable
{
    protected $tableGateway;

   function __construct(TableGatewayInterface $tableGateway)
   {
       $this->tableGateway = $tableGateway;
   }

   public function fetchALL() {
       return $this->tableGateway->select();
   }

   public function saveData($post){
       $data = [
           'title' => $post->getTitle(),
           'description' => $post->getDescription(),
           'category' => $post->getCategory(),
       ];

       return $this->tableGateway->insert($data);
   }

   public function getPost($id){
       $data = $this->tableGateway->select([
           'id'=>$id
       ]);
       return $data->current();
   }

}