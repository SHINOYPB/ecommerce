<?php
class Admin extends CI_Controller
{
    public  function index()

    {
        if ($this->session->userdata('aId')) {
            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/index');
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert warning', 'Plese login first to access your admin panel', 'admin/login');
        }
    }

    public function login()
    {



        $this->load->view('admin/login');
    }

    public function checkAdmin()
    {
        $data['aEmail'] = $this->input->post('email', true);
        $data['aPassword'] = $this->input->post('password', true);

        if (!empty($data['aEmail']) && !empty($data['aPassword'])) {
            $admindata = $this->ModAdmin->checkAdmin($data);
            if (count($admindata) == 1) {
                $forsession = array(
                    'aId' => $admindata[0]['aId'],
                    'aName' => $admindata[0]['aName'],
                    'aEmail' => $admindata[0]['aEmail'],
                );
                $this->session->set_userdata($forsession);
                if ($this->session->userdata('aId')) {
                    redirect('admin');
                } else {
                    echo 'sesssion not created';
                }
            } else {
                setFlashData('alert warning', 'Email and password mismatch', 'admin/login');
            }
        } else {
            setFlashData('alert warning', 'provide required fields', 'admin/login');
        }
    }

    public function logOut()
    {
        if ($this->session->userdata('aId')) {

            $this->session->set_userdata('aId', '');

            setFlashData('alert warning', 'You have Successfully logout', 'admin/login');
        } else {
            setFlashData('alert warning', 'Please login now ', 'admin/login');
        }
    }

    public function newCategory()
    {
        if (adminLoggedIn()) {

            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newCategory');
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert warning', 'Plese login first to access to add your category', 'admin/login');
        }
    }

    public function addCategory()
    {
        if (adminLoggedIn()) {
            $data['cName'] = $this->input->post('categoryName', 'true');
            if (!empty($data['cName'])) {
                $path = realpath(FCPATH . 'assets/images/categories');

                $config['upload_path'] =  $path;
                $config['allowed_types'] = 'gif|png|jpg|jpeg';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('catDp')) {
                    $error = $this->upload->display_errors();
                    setFlashData('alert danger', $error, 'admin/newCategory');
                } else {
                    $fileName = $this->upload->data();
                    $data['cDp'] = $fileName['file_name'];
                    $data['cDate'] = date('Y-m-d h:i:s');
                    $data['adminId'] = getAdminId();
                }
                $addData = $this->ModAdmin->checkCategory($data);
                if ($addData->num_rows() > 0) {

                    setFlashData('alert-danger', 'category already exists add another one', 'admin/newCategory');
                } else {
                    $addData = $this->ModAdmin->addCategory($data);
                    if ($addData) {
                        setFlashData('alert-success', 'successfully added your category', 'admin/newCategory');
                    } else {
                        setFlashData('alert-danger', 'You cannot add your category riht now', 'admin/newCategory');
                    }
                }
            } else {
                setFlashData('alert-danger', 'Category Name is requiered', 'admin/newCategory');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }

    public function allCategories()
    {
        if (adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allCategories');

            $totalRows = $this->ModAdmin->getAllCategories();




            //config for pagination library

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
            $data['allCategories'] = $this->ModAdmin->fetchAllCategories($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();



            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allCategories', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }

    public function editCategory($cId)
    {
        if (adminLoggedIn()) {
            if (!empty($cId) && isset($cId)) {
                $data['category'] = $this->ModAdmin->checkCategoryById($cId);
                if (count($data['category']) == 1) {
                    $this->load->view('admin/header/header');

                    $this->load->view('admin/header/css');

                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editCategory', $data);
                    $this->load->view('admin/header/footer');

                    $this->load->view('admin/header/htmlclose');
                } else {
                    setFlashData('alert-danger', 'Category not found', 'admin/allCategories');
                }
            } else {
                setFlashData('alert-danger', 'Somethinf went wrong', 'admin/allCategories');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }

    public function updateCategory()
    {
        if (adminLoggedIn()) {
            $data['cName'] = $this->input->post('categoryName', true);
            $cId  = $this->input->post('xId', true);
            $oldImg = $this->input->post('oldImg', true);
            if (!empty($data['cName']) && isset($data['cName'])) {
                if (isset($_FILES['catDp']) && is_uploaded_file($_FILES['catDp']['tmp_name'])) {
                    $path = realpath(FCPATH . 'assets/images/categories');

                    $config['upload_path'] =  $path;
                    $config['allowed_types'] = 'gif|png|jpg|jpeg';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('catDp')) {
                        $error = $this->upload->display_errors();
                        setFlashData('alert danger', $error, 'admin/allCategories');
                    } else {
                        $fileName = $this->upload->data();
                        $data['cDp'] = $fileName['file_name'];
                    }
                } //img check
                $replay = $this->ModAdmin->updateCategory($data, $cId);
                if ($replay) {
                    //deleting old image after update new one from assets
                    if (!empty($data['cDp']) && isset($data['cDp'])) {
                        if (file_exists($path . '/' . $oldImg)) {
                            unlink($path . '/' . $oldImg);
                        }
                    }
                    setFlashData('alert-success', 'your have updated successfully category', 'admin/allCategories');
                } else {
                    setFlashData('alert-danger', 'you cannot update your categry right now', 'admin/allCategories');
                }
            } else {
                setFlashData('alert-danger', 'category name is requred', 'admin/allCategories');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }

    public function deleteCategory()
    {
        if (adminLoggedIn()) {
            if ($this->input->is_ajax_request()) {
                $this->input->post('id', true);
                $cId =  $this->input->post('text', true);
                if (!empty($cId) && isset($cId)) {
                    $cId = $this->encryption->decrypt($cId);
                    $oldImg = $this->ModAdmin->getCategoryImage($cId);
                    if (!empty($oldImg) && count($oldImg) == 1) {
                        $realImg = $oldImg[0]['cDp'];
                    }

                    $checkMd = $this->ModAdmin->deleteCategory($cId);
                    if ($checkMd) {
                        if (!empty($realImg) && isset($realImg)) {
                            $path = realpath(FCPATH . 'assets/images/categories');

                            if (file_exists($path . '/' . $realImg)) {
                                unlink($path . '/' . $realImg);
                            }
                        }

                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                    } else {
                        $data['return'] = false;
                        $data['message'] = 'you cannot delete your category right now';
                        echo json_encode($data);
                    }
                } else {
                    $data['return'] = false;
                    $data['message'] = 'value not exits';
                    echo json_encode($data);
                }
            } else {
                setFlashData('alert-danger', 'something went wrong', 'admin/login');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first ', 'admin/login');
        }
    }

    //product section stars here

    public function newProduct()
    {
        if (adminLoggedIn()) {
            $data['categories'] = $this->ModAdmin->getCategories();

            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newProduct', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert warning', 'Plese login first to access to add your Producs', 'admin/login');
        }
    }


    public function addProduct()
    {
        if (adminLoggedIn()) {
            $data['pName'] = $this->input->post('productName', 'true');
            $data['pCompany'] = $this->input->post('company', 'true');
            $data['categoryId'] = $this->input->post('categoryId', 'true');

            if (!empty($data['pName']) && !empty($data['pCompany']) && !empty($data['categoryId'])) {
                $path = realpath(FCPATH . 'assets/images/products');

                $config['upload_path'] =  $path;
                $config['allowed_types'] = 'gif|png|jpg|jpeg';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('prodDp')) {
                    $error = $this->upload->display_errors();
                    setFlashData('alert danger', $error, 'admin/newProduct');
                } else {
                    $fileName = $this->upload->data();
                    $data['pDp'] = $fileName['file_name'];

                    $data['pDate'] = date('Y-m-d H:i:s');
                    $data['adminId'] = getAdminId();
                }
                $addData = $this->ModAdmin->checkProduct($data);
                if ($addData->num_rows() > 0) {

                    setFlashData('alert-danger', 'Product already exists add another one', 'admin/newProduct');
                } else {
                    $addData = $this->ModAdmin->addProduct($data);
                    if ($addData) {
                        setFlashData('alert-success', 'successfully added your Product', 'admin/newProduct');
                    } else {
                        setFlashData('alert-danger', 'You cannot add your Product riht now', 'admin/newProduct');
                    }
                }
            } else {
                setFlashData('alert-danger', 'plese check the required fiels', 'admin/newProduct');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }

    public function allProducts()
    {
        if (adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allProducts');

            $totalRows = $this->ModAdmin->getAllProducts();




            //config for pagination library

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
            $data['allProducts'] = $this->ModAdmin->fetchAllProducts($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();



            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allProducts', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }

    public function editProduct($pId)
    {

        if (adminLoggedIn()) {
            if (!empty($pId) && isset($pId)) {
                $data['products'] = $this->ModAdmin->checkProductById($pId);
                if (count($data['products']) == 1) {
                    $data['categories'] = $this->ModAdmin->getCategories();
                    $this->load->view('admin/header/header');

                    $this->load->view('admin/header/css');

                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editProduct', $data);
                    $this->load->view('admin/header/footer');

                    $this->load->view('admin/header/htmlclose');
                } else {
                    setFlashData('alert-danger', 'Product not found', 'admin/allProducts');
                }
            } else {
                setFlashData('alert-danger', 'Somethinf went wrong', 'admin/allProducts');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }

    public function updateProduct()
    {

        if (adminLoggedIn()) {
            $data['pName'] = $this->input->post('productName', true);
            $data['pCompany'] = $this->input->post('company', true);
            $data['categoryId'] = $this->input->post('categoryId', true);

            $pId  = $this->input->post('xId', true);
            $oldImg = $this->input->post('oldImg', true);

            if (!empty($data['pName']) && isset($data['pName'])) {
                if (isset($_FILES['prodDp']) && is_uploaded_file($_FILES['prodDp']['tmp_name'])) {
                    $path = realpath(FCPATH . 'assets/images/products');

                    $config['upload_path'] =  $path;
                    $config['allowed_types'] = 'gif|png|jpg|jpeg';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('prodDp')) {
                        $error = $this->upload->display_errors();
                        setFlashData('alert danger', $error, 'admin/allProducts');
                    } else {
                        $fileName = $this->upload->data();
                        $data['pDp'] = $fileName['file_name'];
                    }
                } //img check
                $replay = $this->ModAdmin->updateProducts($data, $pId);
                if ($replay) {
                    //deleting old image after update new one from assets
                    if (!empty($data['pDp']) && isset($data['pDp'])) {
                        if (file_exists($path . '/' . $oldImg)) {
                            unlink($path . '/' . $oldImg);
                        }
                    }
                    setFlashData('alert-success', 'your have updated successfully product', 'admin/allProducts');
                } else {
                    setFlashData('alert-danger', 'you cannot update your product right now', 'admin/allProducts');
                }
            } else {
                setFlashData('alert-danger', 'product name is requred', 'admin/allProducts');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }

    public function deleteProduct()
    {
        if (adminLoggedIn()) {
            if ($this->input->is_ajax_request()) {
                $this->input->post('id', true);
                $pId =  $this->input->post('text', true);
                if (!empty($pId) && isset($pId)) {
                    $pId = $this->encryption->decrypt($pId);
                    $oldImg = $this->ModAdmin->getProductImage($pId);
                    if (!empty($oldImg) && count($oldImg) == 1) {
                        $realImg = $oldImg[0]['pDp'];
                    }

                    $checkMd = $this->ModAdmin->deleteProduct($pId);
                    if ($checkMd) {
                        if (!empty($realImg) && isset($realImg)) {
                            $path = realpath(FCPATH . 'assets/images/products');

                            if (file_exists($path . '/' . $realImg)) {
                                unlink($path . '/' . $realImg);
                            }
                        }

                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                    } else {
                        $data['return'] = false;
                        $data['message'] = 'you cannot delete your Product right now';
                        echo json_encode($data);
                    }
                } else {
                    $data['return'] = false;
                    $data['message'] = 'value not exits';
                    echo json_encode($data);
                }
            } else {
                setFlashData('alert-danger', 'something went wrong', 'admin/login');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first ', 'admin/login');
        }
    }

  
    //product section ends here

    //Modle section starts

    public function newModel()
    {
        if (adminLoggedIn()) {
            $data['products'] = $this->ModAdmin->getProducts();

            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newModel', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert warning', 'Plese login first to access to add your models ', 'admin/login');
        }
    }

    public function addModel()
    {
        if (adminLoggedIn()) {
            $data['mName'] = $this->input->post('modelName', 'true');
            $data['mDescription'] = $this->input->post('mDescription', 'true');
            $data['productId'] = $this->input->post('productId', 'true');

            if (!empty($data['mName']) && !empty($data['mDescription']) && !empty($data['productId'])) {
                $path = realpath(FCPATH . 'assets/images/models');

                $config['upload_path'] =  $path;
                $config['allowed_types'] = 'gif|png|jpg|jpeg';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('modDp')) {
                    $error = $this->upload->display_errors();
                    setFlashData('alert danger', $error, 'admin/newModel');
                } else {
                    $fileName = $this->upload->data();
                    $data['mDp'] = $fileName['file_name'];

                    $data['mDate'] = date('Y-m-d H:i:s');
                    $data['adminId'] = getAdminId();
                }
                $addData = $this->ModAdmin->checkModel($data);
                if ($addData->num_rows() > 0) {

                    setFlashData('alert-danger', 'Product already exists add another one', 'admin/newModel');
                } else {
                    $addData = $this->ModAdmin->addModel($data);
                    if ($addData) {
                        setFlashData('alert-success', 'successfully added your Model', 'admin/newModel');
                    } else {
                        setFlashData('alert-danger', 'You cannot add your Model riht now', 'admin/newModel');
                    }
                }
            } else {
                setFlashData('alert-danger', 'plese check the required fiels', 'admin/newModel');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }


    public function allModel()
    {

        if (adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allModel');

            $totalRows = $this->ModAdmin->getAllModels();




            //config for pagination library

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
            $data['allModels'] = $this->ModAdmin->fetchAllModels($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();



            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allModels', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your Models', 'admin/login');
        }
    }

    public function editModel($mId)
    {

        if (adminLoggedIn()) {
            if (!empty($mId) && isset($mId)) {
                $data['models'] = $this->ModAdmin->checkModelById($mId);
                if (count($data['models']) == 1) {
                    $data['products'] = $this->ModAdmin->getProducts();
                    $this->load->view('admin/header/header');

                    $this->load->view('admin/header/css');

                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editModel', $data);
                    $this->load->view('admin/header/footer');

                    $this->load->view('admin/header/htmlclose');
                } else {
                    setFlashData('alert-danger', 'Product not found', 'admin/allModel');
                }
            } else {
                setFlashData('alert-danger', 'Somethinf went wrong', 'admin/allModel');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }


    public function updateModel()
    {


        if (adminLoggedIn()) {
            $data['mName'] = $this->input->post('modelName', true);
            $data['mDescription'] = $this->input->post('mDescription', true);
            $data['productId'] = $this->input->post('productId', true);

            $mId  = $this->input->post('xId', true);
            $oldImg = $this->input->post('oldImg', true);

            if (!empty($data['mName']) && isset($data['mName'])) {
                if (isset($_FILES['modDp']) && is_uploaded_file($_FILES['modDp']['tmp_name'])) {
                    $path = realpath(FCPATH . 'assets/images/models');

                    $config['upload_path'] =  $path;
                    $config['allowed_types'] = 'gif|png|jpg|jpeg';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('modDp')) {
                        $error = $this->upload->display_errors();
                        setFlashData('alert danger', $error, 'admin/allModel');
                    } else {
                        $fileName = $this->upload->data();
                        $data['mDp'] = $fileName['file_name'];
                    }
                } //img check
                $replay = $this->ModAdmin->updateModels($data, $mId);
                if ($replay) {
                    //deleting old image after update new one from assets
                    if (!empty($data['mDp']) && isset($data['mDp'])) {
                        if (file_exists($path . '/' . $oldImg)) {
                            unlink($path . '/' . $oldImg);
                        }
                    }
                    setFlashData('alert-success', 'your have updated successfully Model', 'admin/allModel');
                } else {
                    setFlashData('alert-danger', 'you cannot update your Model right now', 'admin/allModel');
                }
            } else {
                setFlashData('alert-danger', 'Model name is requred', 'admin/allModel');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }

    //Model section ends here

    //spec section stars here

    public function newSpec()
    {
        if (adminLoggedIn()) {
            $data['models'] = $this->ModAdmin->getModel();

            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newSpec', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert warning', 'Plese login first to access to add your Producs', 'admin/login');
        }
    }

    public function addSpec()
    {
        if (adminLoggedIn()) {
            $data['spName'] = $this->input->post('sp_name', true);
            $specValues = $this->input->post('sp_val', true); //receiving array
            // var_dump($specValues);
            // die();
            $specValues = array_filter($specValues);
            $data['modelId'] = $this->input->post('modelId', true);

            if (!empty($data['spName']) && !empty($specValues) && !empty($data['modelId'])) {


                $data['spDate'] = date('Y-m-d H:i:s');
                $data['adminId'] = getAdminId();

                $addData = $this->ModAdmin->checkSpecs($data);
                if ($addData->num_rows() > 0) {

                    setFlashData('alert-danger', 'Spec already exists add another one', 'admin/newSpec');
                } else {
                    $specId = $this->ModAdmin->checkSpecName($data);


                    if (is_numeric($specId)) {
                        $spec_values = array();
                        foreach ($specValues as $specVal) {
                            $spec_values[] = array(
                                'specId' => $specId,
                                'adminId' => $data['adminId'],
                                'spvDate' => date('Y-m-d H:i:s'),
                                'spvName' => $specVal

                            );
                        } //foreach loop here
                        $specValStatus = $this->ModAdmin->checkSpecValues($spec_values);
                        if ($specValStatus) {
                            setFlashData('alert-success', 'successfully added your Spec', 'admin/newSpec');
                        } else {
                            setFlashData('alert-danger', 'You cannot add your Spec values right now', 'admin/newSpec');
                        }
                    } else {
                        setFlashData('alert-danger', 'You cannot add your Spec name right now', 'admin/newSpec');
                    }
                    // $addData = $this->ModAdmin->addSpec($data);
                    // if ($addData) {
                    //     setFlashData('alert-success', 'successfully added your Spec', 'admin/newSpec');
                    // } else {
                    //     setFlashData('alert-danger', 'You cannot add your Spec values riht now', 'admin/newSpec');
                    // }
                }
            } else {
                setFlashData('alert-danger', 'plese check the required fiels', 'admin/newSpec');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }

    public function allSpecs()
    {

        if (adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allSpecs');

            $totalRows = $this->ModAdmin->getAllSpecs();




            //config for pagination library

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
            $data['allSpecs'] = $this->ModAdmin->fetchAllSpecs($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();



            $this->load->view('admin/header/header');

            $this->load->view('admin/header/css');

            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allSpecs', $data);
            $this->load->view('admin/header/footer');

            $this->load->view('admin/header/htmlclose');
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your Models', 'admin/login');
        }
    }

    public function deleteSpec()
    {
        if (adminLoggedIn()) {
            if ($this->input->is_ajax_request()) {
                $this->input->post('id', true);
                $spId =  $this->input->post('text', true);
                if (!empty($spId) && isset($spId)) {
                    $spId = $this->encryption->decrypt($spId);

                    $checkMd = $this->ModAdmin->deleteSpec($spId);
                    if ($checkMd) {

                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                    } else {
                        $data['return'] = false;
                        $data['message'] = 'you cannot delete your Spec right now';
                        echo json_encode($data);
                    }
                } else {
                    $data['return'] = false;
                    $data['message'] = 'value not exits';
                    echo json_encode($data);
                }
            } else {
                setFlashData('alert-danger', 'something went wrong', 'admin/login');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first ', 'admin/login');
        }
    }

    public function editSpec($spId)
    {

        if (adminLoggedIn()) {
            if (!empty($spId) && isset($spId)) {
                $data['Spec'] = $this->ModAdmin->checkSpecById($spId);
                if (count($data['Spec']) == 1) {
                    $data['models'] = $this->ModAdmin->getModel();
                    $this->load->view('admin/header/header');

                    $this->load->view('admin/header/css');

                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editSpec', $data);
                    $this->load->view('admin/header/footer');

                    $this->load->view('admin/header/htmlclose');
                } else {
                    setFlashData('alert-danger', 'Product not found', 'admin/allProducts');
                }
            } else {
                setFlashData('alert-danger', 'Somethinf went wrong', 'admin/allProducts');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to edit your category', 'admin/login');
        }
    }

    public function updateSpec()
    {
        if (adminLoggedIn()) {
            $data['spName'] = $this->input->post('sp_name', true);
            $data['modelId'] = $this->input->post('modelId', true);
            $SpecId = $this->input->post('specid', true);

            if (!empty($data['spName']) && !empty($SpecId) && !empty($data['modelId'])) {


                $addData = $this->ModAdmin->checkSpecs($data);
                if ($addData->num_rows() > 0) {

                    setFlashData('alert-danger', 'Spec already exists add another one', 'admin/allSpecs');
                } else {
                  


                    $updateSpec = $this->ModAdmin->updatSpec($data,$SpecId);
                    if ($updateSpec) {
                        setFlashData('alert-success', 'successfully updated your Spec', 'admin/allSpecs');
                    } else {
                        setFlashData('alert-danger', 'You cannot update your Spec values right now', 'admin/allSpecs');
                    }
                }
            } else {
                setFlashData('alert-danger', 'plese check the required fiels', 'admin/allSpecs');
            }
        } else {
            setFlashData('alert-danger', 'Plese login first to access to add your category', 'admin/login');
        }
    }


    //Spec section ends here

}//class ends here
