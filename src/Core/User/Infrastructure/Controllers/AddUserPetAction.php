<?php

namespace Peludors\Core\User\Infrastructure\Controllers;

use Flight;
use Peludors\Core\User\Application\AddUserPet\AddUserPet;
use Peludors\Core\User\Application\AddUserPet\AddUserPetCommand;

readonly class AddUserPetAction
{
    public function __construct(
        protected AddUserPet $addUserPet
    )
    {
    }

    public function __invoke():void
    {
        $name = trim($_POST['name']);
        $type = $_POST['petType'];
        $customType = trim($_POST['customType']);
        $breed = $_POST['breed'] ?? null;
        $customBreed = trim($_POST['customBreed'] );
        $birthDate = strtotime($_POST['birthDate']);
        $deathDate = strtotime($_POST['deathDate']);
        $mixedBreed = $_POST['mixedBreed'] ?? 0;
        $biography = trim($_POST['biography'] ?? null);
        $farewell = trim($_POST['farewell'] ?? null);
        $finalType = ($type === 'otro') ? $customType : $type;
        $finalBreed = ($breed === 'Otro') ? $customBreed : $breed;


        $photoPath = null;
        if (!empty($_FILES['photo']['tmp_name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $fileType = $_FILES['photo']['type'];
            $fileSize = $_FILES['photo']['size'];

            if (in_array($fileType, $allowedTypes) && $fileSize <= 5 * 1024 * 1024) {
                $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('pet_') . "." . $ext;
                $uploadDir = __DIR__ . '/../uploads/photo/pets/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $uploadFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $photoPath = "/uploads/photo/pets/" . $filename;
                }
            }
        }

        $petData = [
            'userID'=> 1,//obtenerlo de la cookie
            'name' => $name,
            'type' => $finalType,
            'breed' => $finalBreed,
            'birthDate' => $birthDate,
            'deathDate' => $deathDate,
            'mixedBreed' => $mixedBreed,
            'biography' => $biography,
            'farewell' => $farewell,
            'photoPath' => $photoPath
        ];

        $command = new AddUserPetCommand($petData);
        $message = $this->addUserPet->__invoke($command);
        echo Flight::view()->render('userPanel.twig',['message' => $message]);
    }

}