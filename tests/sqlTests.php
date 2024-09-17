<?php

use PHPUnit\Framework\TestCase;

// equire_once __DIR__ . '/../model/EventParticipants.php';
class SqlTest extends TestCase
{

    public function testEventParticipants()
    {
        $event_participants = new EventParticipants();
        $event_participants->id_events = 1;
        $event_participants->email = "placeholder@gmail.com";
        $event_participants->firstname = "placeholder";
        $event_participants->lastname = "placeholder";
        $event_participants->id_users = "";

        $requests_list = ["user/profile", "user/decode"];
        $this->assertTrue($event_participants->add(), "Echec d'ajout");

        $participants = $event_participants->getParticipants();

        $this->assertNotEmpty($participants,"Participants ne devraient pas être vide");
        
    }
}