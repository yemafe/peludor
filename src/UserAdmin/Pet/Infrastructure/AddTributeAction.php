<?php

namespace Peludors\UserAdmin\Pet\Infrastructure;

use DomainException;
use Flight;
use Peludors\Shared\Infrastructure\Services\TextSanitizer;
use Peludors\UserAdmin\Pet\Application\AddTribute\AddTribute;
use Peludors\UserAdmin\Pet\Application\AddTribute\AddTributeCommand;
use Peludors\UserAdmin\User\Infrastructure\Services\GetUserSessionData;

readonly class AddTributeAction
{
    public function __construct(
        protected AddTribute         $addUserPet,
        protected GetUserSessionData $getUserSessionData
    ){
    }

    public function __invoke():void
    {
        $name = TextSanitizer::sanitize($_POST['name'] ?? '');
        $type = TextSanitizer::sanitize($_POST['petType'] ?? '');
        $customType = TextSanitizer::sanitize($_POST['customType'] ?? '');
        $breed = isset($_POST['breed']) ? TextSanitizer::sanitize($_POST['breed']) : null;
        $customBreed = isset($_POST['customBreed']) ? TextSanitizer::sanitize($_POST['customBreed']) : null;
        $birthDate = strtotime($_POST['birthDate']);
        $deathDate = strtotime($_POST['deathDate']);
        $mixedBreed = $_POST['mixedBreed'] ?? 0;
        $biography = isset($_POST['biography']) ? TextSanitizer::sanitize($_POST['biography']) : null;
        $farewell = isset($_POST['farewell']) ? TextSanitizer::sanitize($_POST['farewell']) : null;
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
                $uploadDir = __ROOT_DIR__ . '/public/uploads/users/photo/pets/'; //accesible desde http://localhost/uploads/users/photo/pets/<archivo>

                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $uploadFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    //$photoPath = "/uploads/photo/pets/" . $filename;
                    $photoPath = $filename;
                }
            }
        }

        $petData = [
            'userID'=> $this->getUserSessionData->__invoke()['userID'],
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

        try {
            $command = new AddTributeCommand($petData);
            $message = $this->addUserPet->__invoke($command);
            $_SESSION['flash_message'] = $message;
            Flight::redirect('/userPanel');
        } catch (DomainException $e) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['flash_message'] = $e->getMessage();
            Flight::redirect('/userPanel');
        }
    }
}