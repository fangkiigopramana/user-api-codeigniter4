<?php

namespace App\Controllers;

use App\Models\User as ModelsUser;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{

    protected $modelName = 'App\Models\User';
    protected $format    = 'json';


    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return $this->respond($this->model->findAll(),200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $user = $this->model->find($id);
        if (is_null($user)) {
            $user = [];
        }
        return $this->respond($user, 200);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {

    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    use ResponseTrait;

    public function create()
    {
        $rules = [
            'name' => ['rules' => 'required'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ];

        if($this->validate($rules)){
            $model = new ModelsUser();
            $data = [
                'name'    => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
             
            return $this->respond([
                'message' => 'Create New User Successfully',
                'data' => [
                        'name' => $data['name'],
                        'email' => $data['email'],
                    ]
            ], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'                
            ];
            return $this->fail($response , 409);
             
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $data = [
            'name' => $this->request->getVar('name'),
            'email'   => $this->request->getVar('email'),
        ];

        $rules = [
            'name'   => 'required',
            'email'  => 'required|valid_email',
        ];

        if (!$this->validateData($data, $rules)){
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }
        $this->model->update($id, [
            'name'   => esc( $this->request->getVar('name')),
            'email'         => esc( $this->request->getVar('email')),
        ]);

        $response = [
            'message' => 'Update User Successfully'
        ];

        return $this->respond($response, 200);
    }
    

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $user = $this->model->delete($id);
        if (!$user) {
            $response = [
                'message' => 'Delete User Failed'
            ];
        } else {   
            $response = [
                'message' => 'Delete User Successfully'
            ];
        }

        return $this->respond($response, 200);
    }
}
