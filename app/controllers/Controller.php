<?php

namespace App\Controllers;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);

        $viewPath = APP_ROOT . '/app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die('Vue introuvable : ' . $view);
        }

        require_once $viewPath;
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . APP_URL . '/' . $url);
        exit();
    }

    protected function requireAuth(): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('login');
        }
    }

    protected function requireAdmin(): void
    {
        if (empty($_SESSION['admin'])) {
            $this->redirect('admin/login');
        }
    }

    protected function json(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
