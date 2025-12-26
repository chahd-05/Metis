<?php

require_once __DIR__ . '/../Models/Member.php';
require_once __DIR__ . '/../Models/ShortProject.php';
require_once __DIR__ . '/../Models/LongProject.php';
require_once __DIR__ . '/../Models/Activity.php';

while (true) {

    echo "\n ===🤗 MENU🤗 === \n";
    echo "1. => Add member\n";
    echo "2. => List members\n";
    echo "3. => Add project\n";
    echo "4. => Add activity\n";
    echo "5. => Activities history\n";
    echo "6. => Projects history\n";
    echo "7. => Delete project\n";
    echo "0. => Exit\n";


    $choice = readline("choice : ");

    switch ($choice) {

        case '1':
            $full_name = readline("full_name : ");
            $email = readline("Email : ");
            $password = readline("password : ");

            try {
                $m = new Membre($full_name, $email, $password);
                $m->create();
                echo "Member added succesfully ✔\n";
            } 
            catch (Exception $e) {
                echo $e->getMessage() . "\n";
            }
            break;

        case '2':
            $members = Membre::getAll();
            foreach ($members as $m) {
                echo $m['id'] . " - " . $m['full_name'] . "\n";
            }
            break;

        case '3':
            $project_title = readline("project_title : ");
            $member_id = readline("member_Id : ");
            $type = readline("Type (short_P/long_P) : ");

            $projet = ($type === 'short')
                ? new shortProject($project_title, $member_id)
                : new LongProject($project_title, $member_id);

            $projet->create();
            echo "Project added succesfully ✔\n";
            break;

        case '4':
            $title = readline("activity_name : ");
            $desc = readline("Description : ");
            $project_id = readline("ID project : ");
            try{
            $a = new Activity($title,$desc, $project_id);
            $a->create();
            echo "Activity added succesfully ✔\n";
            }
            catch(Exception $e){
                echo $e->getMessage() . "\n";
            }
            break;

        case '5':
            $project_id = readline("ID project : ");
            $acts = Activity::getByActivity($project_id);

            foreach ($acts as $a) {
                echo $a['activity_date'] . " - " . $a['description'] . "\n";
            }
            break;

        case '6':
            $member_id = readline("ID member : ");
            $act = Project::getByProjet($member_id);

            foreach ($act as $n) {
                echo $n['id'] . " - " . $n['project_title'] . "\n";
            }
            break;
        case '7':
            $member_id = readline("member_id : ");
           
            try {
                $delete = Membre::delete($member_id);
                echo "Member deleted succesfully!";
            }
            catch(Exception $e){
                echo $e->getMessage() . "\n";
            }
            break;
            
        case '0':
            exit("GoodBye!👋\n");

        default:
            echo "invalid choice!❌\n";
    }
}
