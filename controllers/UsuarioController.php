<?php

namespace controllers;

use Core\Auth;
use Models\Usuario;
use Render;
use Repository\UsuarioRepository;

class UsuarioController
{

    public function index()
    {
        $usuarios = UsuarioRepository::getAll();
        Render::html('Views\AdminLayout', 'Login/usuarios', ['usuarios' => $usuarios]);
    }

    public function boton()
    {
        if (!empty(Auth::getUser())) {
            $this->botonUsuario();
        } else {
            $this->botonLogin();
        }
    }

    public function botonLogin()
    {
        $usuario = Auth::getUser();

        require_once("views/Login/botonlogin.php");
    }

    public function botonUsuario()
    {
        $usuario = Auth::getUser();

        if (!Auth::isAdmin()) {
            require_once("views/Login/botoncliente.php");
        } else {
            require_once("views/Login/botonadmin.php");
        }

    }

    public function botonLogout()
    {

        if (!empty(Auth::getUser())) {
            $usuario = Auth::getUser();
            require_once("views/Login/botonlogout.php");
        }
    }

    public function panel()
    {
        $usuario = Auth::getUser();

        if (isset($_POST['enviar']) && !empty($_POST['password'])) {

            $id = $_POST['id'];

            $usuario = UsuarioRepository::getById($id);

            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $usuario->setPassword($hash);

            UsuarioRepository::update($usuario);
        }

        Render::html('Views\AdminLayout', 'Login/panelusuario', ['usuario' => $usuario]);
    }

    public function login()
    {
        if (isset($_POST['enviar']) && empty(Auth::getUser())) {

            $usuario = UsuarioRepository::login($_POST['email'], $_POST['password']);

            if (isset($usuario)) {

                Auth::login($usuario);

                if (Auth::isAdmin()) {

                    header('Location: ' . BASE_DIR . 'admin/productos');

                } else {

                    header('Location: ' . BASE_DIR . 'usuarios/panelusuario/');

                }
            } else {
                header('Location: ' . BASE_DIR . 'usuarios/login');
            }

        } elseif (!empty(Auth::getUser())) {

            if (Auth::isAdmin()) {

                header('Location: ' . BASE_DIR . 'admin/productos');

            } else {

                header('Location: ' . BASE_DIR . 'usuarios/panelusuario/');

            }
        } else {

            Render::html('Views\AdminLayout', 'Login/login', []);

        }
    }

    public function logout()
    {

        Auth::logout();

        Render::html('Views\AdminLayout', 'Login/login', []);

    }

    public function agregar()
    {
        if (isset($_POST['enviar'])) {
            if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && strlen($_POST['password']) >= 3) {
                if (UsuarioRepository::existsEmail($_POST['email'])) {
                    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    if (Auth::isAdmin()) {
                        $usuario = new Usuario(null, $_POST['username'], $_POST['email'], $hash, 1);
                    } else {
                        $usuario = new Usuario(null, $_POST['username'], $_POST['email'], $hash, 0);
                    }
                    UsuarioRepository::save($usuario);
                    Auth::login($usuario);
                    header("Location: " . BASE_URL . "/usuarios/panelusuario/");
                } else {
                    $error = 'Email ya registrado';
                    Render::html('Views\AdminLayout', 'Login/registro', ['error' => $error]);
                }
            } else {
                $error = 'No puede haber campos vacios';
                Render::html('Views\AdminLayout', 'Login/registro', ['error' => $error]);

            }
        } else {
            Render::html('Views\AdminLayout', 'Login/registro', []);
        }
    }

    public function eliminar($params)
    {
        UsuarioRepository::delete($params);

        $usuarios = UsuarioRepository::getAll();

        Render::html('Views\AdminLayout', 'Login/usuarios', ['usuarios' => $usuarios]);
    }

    public function editar($params)
    {

        $usuario = UsuarioRepository::getById($params);

        UsuarioRepository::update($usuario);

        Render::html('Views\AdminLayout', 'Login/panelusuario', ['usuario' => $usuario]);

    }

    public function botonesSidebar()
    {

        if (!empty(Auth::getUser())) {
            if (Auth::isAdmin()) {
                require_once('views/botonesSidebarAdmin.php');
            } else {
                require_once('views/botonesSidebarCliente.php');
            }
        }
    }
}
