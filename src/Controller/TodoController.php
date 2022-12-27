<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{

    //listing des tâches
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        // Afficher mon tableau todo
        $session = $request->getSession();
        // si je n'ai pas mon tableau todo dans la session, je l'initialise avant de l'afficher
        if (!$session->has("todo")) {
            $todo = [
                "achat" => "acheter clé usb",
                "cours" => "finaliser mon cours",
                "correction" => "corriger mes examens"
            ];
            $session->set("todo", $todo);
            $this->addFlash("info", "Enregistrement bien effectué");
        }
        // sinon je l'affiche
        return $this->render('todo/index.html.twig');
    }

    //Ajout d'une tâche
    #[Route('/todo/add/{name}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content): Response
    {
        $session = $request->getSession();
        // Vérifier si j'ai mon tableau todo dans la session
        if ($session->has('todo')) {
            //si oui
            //vérifier que le todo n'est pas le même que celui de la session
            $todo = $session->get('todo');
            if (isset($todo[$name])) {
                //Si oui, afficher erreur
                $this->addFlash("error", "La tâche $name existe déjà dans la liste");
            } else {
                //si non, le nouveau todo est enregistré et afficher un message de succès
                $todo[$name] = $content;
                $session->set('todo', $todo);
                $this->addFlash("success", "Enregistrement de la tâche $name a bien été effectuée");
            }
        } else {
            //si non
            //Afficher une erreur et rediriger vers le controller index
            $this->addFlash("error", "la liste n'est pas encore initialisée");
        }
        return $this->redirectToRoute("todo");
    }

    //Modification d'une tâche
    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): Response
    {
        $session = $request->getSession();
        // Vérifier si j'ai mon tableau todo dans la session
        if ($session->has('todo')) {
            //si oui
            //vérifier que le todo n'est pas le même que celui de la session
            $todo = $session->get('todo');
            if (!isset($todo[$name])) {
                //Si oui, afficher erreur
                $this->addFlash("error", "La tâche $name n'existe pas dans la liste");
            } else {
                //si non, le nouveau todo est enregistré et afficher un message de succès
                $todo[$name] = $content;
                $session->set('todo', $todo);
                $this->addFlash("success", "La modification de la tâche $name a bien été effectuée");
            }
        } else {
            //si non
            //Afficher une erreur et rediriger vers le controller index
            $this->addFlash("error", "la liste n'est pas encore initialisée");
        }
        return $this->redirectToRoute("todo");
    }


    //Suppression d'une tâche
    #[Route('/todo/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): Response
    {
        $session = $request->getSession();
        // Vérifier si j'ai mon tableau todo dans la session
        if ($session->has('todo')) {
            //si oui
            //vérifier que le todo n'est pas le même que celui de la session
            $todo = $session->get('todo');
            if (!isset($todo[$name])) {
                //Si oui, afficher erreur
                $this->addFlash("error", "La tâche $name n'existe pas dans la liste");
            } else {
                //si non, le nouveau todo est enregistré et afficher un message de succès
                unset($todo[$name]);
                $session->set('todo', $todo);
                $this->addFlash("success", "La suppression de la tâche $name a bien été effectuée");
            }
        } else {
            //si non
            //Afficher une erreur et rediriger vers le controller index
            $this->addFlash("error", "la liste n'est pas encore initialisée");
        }
        return $this->redirectToRoute("todo");
    }

    #[Route('/todo/reset', name: 'todo.reset')]
    public function resetTodo(Request $request): Response
    {
        $session = $request->getSession();
        $session->remove('todo');
        $this->addFlash("infor", "la session a été réinitialisée");
        return $this->redirectToRoute("todo");
    }
}
