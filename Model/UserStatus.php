<?php

App::uses('AppModel', 'Model');

class UserStatus extends AppModel {
   
    const TimeLimit = 2;
    const ChauffeurAcceptTimeLimit = 3;
    const ChauffeurTimeLimit = 15;
    const CarwashTimeLimit = 15;
    const GargeAcceptTimeLimit = 3;
    
      
    const Agent = 1;
    const Customer = 2;
    const Chauffeur = 3;
    const ChauffeurService = 4;
    const Garage = 5;
    const Mechanic = 6;
    
    //Service Types
    const RoadsideAssistance = 1;
    const Maintenance = 2;
    const BookChauffeur = 3;
    const Tyres = 4;
    const Batteries = 5;
    const CarWash = 6;
    const Transport = 7;
    
    //For Breakdown Services
    const BdownMapped = 1;
    const BdownAssigned = 2;
    const BdownAccepted = 3;
    const BdownReached = 4;
    const BdownJobCompleted = 5;
    const BdownOnlinePayment = 6;
    const BdownOfflinePayment = 7;
    const BdownPaymentReceived = 8;
    const BdownCanceled = 9;
    const BdownDeclined = 10;
    
    //For Chauffeur Servioces
    const ChMapped = 1;
    const ChAssigned = 2;
    const ChAccepted = 3;
    const ChReached = 4;
    const ChJobStarted = 5;
    const ChJobCompleted = 6;
    const ChOnlinePayment = 7;
    const ChOfflinePayment = 8;
    const ChPaymentReceived = 9;
    const ChDeclined = 10;
    const ChCanceled = 11;
    const ChRescheduled = 12;
    
    //General Request
    const GNMapped = 1;
    const GNAssigned = 2;
    const GNAccepted = 3;
    const GNReached = 4;
    const GNPickup = 5;
    const GNReachedToGarage = 6;
    const GNJobStarted = 7;
    const GNJobCompleted = 8;
    const GNDropInditiator = 9;
    const GNDroped = 10;
    const GNPaymentProcessing = 11;
    const GNPaymentReceived = 12;
    const GNDeclined = 13;
    const GNCanceled = 14;
    const GNRescheduled = 15;
    
    //mechanic type
    const Allocate = 1;
    const Pickup = 2;
    const Drop = 3;
}
