<?php

App::uses('Component', 'Controller');

class ResponseMessageComponent extends Component {

    public function startup(Controller $controller) {
        $this->_controller = $controller;
    }

    public function message($case) {
        switch ($case) {

            //General Request
            case 'UnknownStatus':
                $message = __('Unknown status.');
                break;
            case 'ChangeStatusFailed':
                $message = __('Status change failed.');
                break;
            case 'DropedFailed':
                $message = __('Mechanic drop failed.');
                break;
            case 'DropedSuccess':
                $message = __('Mechanic droped successfully.');
                break;
            case 'DropInitiatedFailed':
                $message = __('Mechanic drop initiated failed.');
                break;
            case 'DropInitiated':
                $message = __('Mechanic drop initiated successfully.');
                break;
            case 'MechanicPickupFailed':
                $message = __('Mechanic pickup failed.');
                break;
            case 'MechanicPickupSuccess':
                $message = __('Mechanic pickup successfully.');
                break;
            case 'PaymentProcessing':
                $message = __('Payment processing.');
                break;
            case 'DropedSuccess':
                $message = __('Droped successfully.');
                break;
            case 'DropInitiated':
                $message = __('Drop initiated successfully.');
                break;
            case 'JobCompleted':
                $message = __('Job completed successfully.');
                break;
            case 'JobStarted':
                $message = __('Job started successfully.');
                break;
            case 'JobStartedFailed':
                $message = __('Job started failed.');
                break;
            case 'MechanicReachedGarage':
                $message = __('Mechanic reached to garage successfully.');
                break;
            case 'MechanicReachedGarageFailed':
                $message = __('Mechanic reached to garage failed.');
                break;
            case 'MechanicPicked':
                $message = __('Mechanic picked successfully.');
                break;
            case 'PricingInfoFailed':
                $message = __('Price list failed.');
                break;
            case 'RequestSuccess':
                $message = __('Request has been registered.');
                break;
            case 'RequestFailure':
                $message = __('Request has not been registered.Please try again.');
                break;
            
            //chauffeur pricing Info
            case 'PricingInfoSucccess':
                $message = __('Price listed successfully.');
                break;
            case 'NoPricingInfoForLocation':
                $message = __('We are yet to launch in your location. Please come back soon.');
                break;
            case 'CityInfoFailure':
                $message = __('City not found for this latitude and longitude.');
                break;

            //Chauffeur request
            case 'ChauffeurRequestSuccess':
                $message = __('Chauffeur Request has been registered.');
                break;
            case 'ChauffeurRequestFailure':
                $message = __('Chauffeur Request has not been registered.Please try again.');
                break;


            // Notification success Starts
            case 'NotificationSuccess':
                $message = __('Push notification registration successful.');
                break;
            case 'NotificationFailure';
                $message = __('Push notification registration unsuccessful.');
                break;
            case 'SendNotificationFailiure':
                $message = __('New notifications not found.');
                break;
            case 'updateNotificationFailiure':
                $message = __('Notification permissions could not be updated. Check user id');
                break;
            case 'updateNotificationSuccess':
                $message = __('Notification permissions updated  successfully.');
                break;
            case 'updateNotificationData':
                $message = __('Please enter user id and push notification status.');
                break;

            //Login Starts
            case 'UserNotFound':
                $message = __('Incorrect email or Password.');
                break;
            case 'LoginSuccess':
                $message = __('Login success');
                break;
            case 'LoginFailure':
                $message = __('Invalid credentials');
                break;

            //Master Starts
            case 'MasterItemFoundMessage':
                $message = __('Masters found');
                break;
            case 'MasterNoItemsFoundMessage':
                $message = __('Masters not found');
                break;
            case 'MasterNoUpdatedItemsFoundMessage':
                $message = __('No updated masters found');
                break;

            //Registered Users Starts
            case 'UserLoginEmptyMessage':
                $message = __('Email and PIN should not be empty.');
                break;
            case 'RegistraionSuccess':
                $message = __('User registration successful.');
                break;
            case 'RegistraionFailure':
                $message = __('User registration unsuccessful.');
                break;

            //Customer Information Starts
            case 'CustomerAddSuccess':
                $message = __('User information added Successfully.');
                break;
            case 'CustomerUpdateSuccess':
                $message = __('User information updated Successfully.');
                break;
            case 'CustomerFailure':
                $message = __('User information has not been added.Please try again.');
                break;
            case 'CustomerListSucccess':
                $message = __('Customer listed successfully.');
                break;
            case 'CustomerListFailed':
                $message = __('Customer not found.');
                break;
            case 'CityListSucccess':
                $message = __('City listed successfully.');
                break;
            case 'ServiceListSucccess':
                $message = __('Services listed successfully.');
                break;
            case 'CityListFailed':
                $message = __('City not found.');
                break;
            case 'UserUpdateSuccess':
                $message = __('User updated successfully.');
                break;
            case 'UserUpdateFailure':
                $message = __('User updated failed.');
                break;

            //Forgot PIN Starts
            case 'ResetPINSuccess':
                $message = __('Password reset instruction has been sent to your registered email .');
                break;
            case 'ResetPINFailure':
                $message = __('Please enter your registered email.');
                break;


            //Sign In OTP Request
            case 'OTPSent':
                $message = __('OTP sent');
                break;
            case 'OTPNotSend':
                $message = __('Incorrect OTP');
                break;
            case 'PhoneNotExist':
                $message = __('Number does not exists');
                break;
            case 'PhoneExist':
                $message = __('Success');
                break;
            case 'PhoneValidateFailure':
                $message = __('Phone number validate failed.');
                break;

            //Sign In OTP Verify
            case 'VerifyOTPSuccess':
                $message = __('Success');
                break;
            case 'OTPExpired':
                $message = __('OTP expired');
                break;
            case 'OTPVerifyFailed':
                $message = __('OTP verification failed');
                break;

            //Sign Up OTP Request
            case 'OTPPhoneNoExist':
                $message = __('Phone number already exists');
                break;
            case 'UserCreatedMessage':
                $message = __('Customer verified and created successfully');
                break;
            case 'VerifiedSuccess':
                $message = __('Customer verified successfully');
                break;

            //Garage Information Starts
            case 'GarageSuccess':
                $message = __('Garage Information has been updated.');
                break;
            case 'GarageFailure':
                $message = __('Garage Information has not been updated.Please try again.');
                break;

            //Garage Image upload status
            case 'GarageImageSuccess':
                $message = __('Garage Images has been uploaded Successfully.');
                break;
            case 'GarageImageFailure':
                $message = __('Garage Image has not been uploaded.Please try again.');
                break;

            //Card Starts
            case 'CardAddSuccess':
                $message = __('Your card has been added successfully.');
                break;
            case 'CardAddFailure':
                $message = __('Your card has not been added. Please try again.');
                break;
            case 'CardUpdateSuccess':
                $message = __('Your card has been updated successfully.');
                break;
            case 'CardUpdateFailure':
                $message = __('Your card has not been updated. Please try again.');
                break;
            case 'CardDeleteSuccess':
                $message = __('The card has been removed successfully from your account.');
                break;
            case 'CardNotFound':
                $message = __('The specified card id does not exists.');
                break;
            case 'CardExists':
                $message = __('Specified card already exists in your account.');
                break;

            //Vehicle Starts
            case 'UserVehicleSuccess':
                $message = __('Your Vehicle has been added successfully.');
                break;
            case 'EditUserVehicleSuccess':
                $message = __('Your Vehicle has been updated successfully.');
                break;
            case 'EditUserVehicleFailure':
                $message = __('Your Vehicle has not been updated. Please try again.');
                break;
            case 'UserVehicleFailure':
                $message = __('Your Vehicle has not been added. Please try again.');
                break;
            case 'UserVehicleNotExist':
                $message = __('No vehicle found.');
                break;
            case 'UserVehicleExist':
                $message = __('Your Vehicle already exist. Please try with another vehicle.');
                break;
            case 'VehicleDeleteSuccess':
                $message = __('Your Vehicle deleted successfully.');
                break;
            case 'VehicleDeleteFailed':
                $message = __('Your Vehicle has not been deleted. Please try again.');
                break;
            case 'VehicleUpdateSuccess':
                $message = __('Your Vehicle has been updated successfully.');
                break;
            case 'VehicleUpdateFailure':
                $message = __('Your Vehicle has not been updated. Please try again.');
                break;
            case 'VehicleNotFound':
                $message = __('The specified Vehicle id does not exists.');
                break;
            case 'VehicleDeleteSuccess':
                $message = __('The Vehicle has been removed successfully from your account.');
                break;
            case 'VehicleDeleteFailure':
                $message = __('The specified Vehicle id does not exists.');
                break;
            case 'VehicleExists':
                $message = __('Specified vehicle already exists in your account.');
                break;
            case 'ListUserVehicleSuccess':
                $message = __('User vehicle(s) listed successfully');
                break;

            //Privacy Policy Starts
            case 'getPrivacyPolicyFailure':
                $message = __('Please check given privacy policy ID.');
                break;

            // Update PIN
            case 'UpdatePINSuccess':
                $message = __('PIN updated successfully.');
                break;
            case 'UpdatePINFailure':
                $message = __('Incorrect current PIN.');
                break;

            //Update bay status
            case 'BayNotFound':
                $message = __('Incorrect Bay ID.');
                break;
            case 'checkStatus':
                $message = __('Status update failed. Please try again.');
                break;

            //Update Profile
            case 'UpdateProfileSuccess':
                $message = __('Profile updated successfully.');
                break;
            case 'UpdateProfileFailure':
                $message = __('Profile updated unsuccessfully.');
                break;

            //Signout
            case 'LogoutSuccess':
                $message = __('Logout successfull.');
                break;
            case 'LogoutFailiure':
                $message = __('Logout unsuccessfull.');
                break;

            //Select Bay
            case 'selectBayFailure':
                $message = __('No zones available at the current location.');
                break;
            case 'BayInfoNotFound':
                $message = __('Bay Information not available.');
                break;
            case 'BayInfoNotFoundAtTime':
                $message = __('Bay Information not available at the given arrival time.');
                break;

            //Update Bay
            case 'UpdateBayStatusSuccess':
                $message = __('Bay status has been updated successfully.');
                break;
            case 'UpdateBayStatusFailure':
                $message = __('Bay status has not been updated.');
                break;

            //Zone select
            case 'ZoneSelectSuccess':
                $message = __('Given latitude and longitude within the zone.');
                break;
            case 'ZoneSelectFailure':
                $message = __('Given latitude and longitude not in the zone.');
                break;
            case 'ZoneNotFound':
                $message = __('Zone details not found.');
                break;

            //Ticket
            case 'TicketSuccess':
                $message = __('Ticket generated successfully.');
                break;
            case 'TicketFailure':
                $message = __('Bay is not available.');
                break;

            //Get profile
            case 'getProfileFailure':
                $message = __('The specified user id does not exists.');
                break;

            //Get transaction
            case 'getTransactionFailiure':
                $message = __('Transaction not found in the given date range.');
                break;
            case 'transactionNotFound':
                $message = __('Transactions not found.');
                break;

            // Contact Starts

            case 'contactInfoFailure':
                $message = __('New updates not found in contact info.');
                break;

            //Common Starts
            case 'AccountInactive':
                $message = __('Your account is not active, please contact the Administrator.');
                break;

            case 'Success':
                $message = __('Success');
                break;
            case 'Failure':
                $message = __('Failure');
                break;
            case 'InternalServiceError':
                $message = __('Internal Service Error, Please try again.');
                break;
            case 'BreakdownRequestSuccess':
                $message = __('Breakdown Request has been registered.');
                break;
            case 'BreakdownRequestFailure':
                $message = __('Breakdown Request has not been registered.Please try again.');
                break;
            case 'ChauffeurRequestSuccess':
                $message = __('Chauffeur Request has been registered.');
                break;
            case 'ChauffeurRequestFailure':
                $message = __('Chauffeur Request has not been registered.Please try again.');
                break;
            case 'AssignChauffeurSuccess':
                $message = __('Chauffeur assigned successfully.');
                break;
            case 'AssignChauffeurFailure':
                $message = __('Chauffeur assign failed.');
                break;
            case 'BreakdownServiceNotAvailable':
                $message = __('Service not available');
                break;
            case 'UserAddSuccess':
                $message = __('User added successfully.');
                break;
            case 'UserFailure':
                $message = __('User has not been added.Please try again.');
                break;
            case 'UserExist':
                $message = __('User already exist.Please try with another user.');
                break;
            case 'IMEImismatch':
                $message = __('Device IMEI number does not match,please try again.');
                break;
            case 'MechanicSuccess':
                $message = __('Mechanic successfully added.');
                break;
            case 'MechanicFailure':
                $message = __('Mechanic has not been added, Please try again.');
                break;
            case 'EmailExist':
                $message = __('Email id already exist, Please try with another email id.');
                break;
            case 'MechanicUpdateSuccess':
                $message = __('Mechanic successfully updated.');
                break;
            case 'MechanicUpdateFailure':
                $message = __('Mechanic has not been updated, Please try again.');
                break;
            case 'ChauffeurUpdateSuccess':
                $message = __('Chauffeur successfully updated.');
                break;
            case 'ChauffeurUpdateFailure':
                $message = __('Chauffeur has not been updated, Please try again.');
                break;
            case 'AcceptMechanicSuccess':
                $message = __('Mechanic accepted successfully.');
                break;
            case 'MechanicAlreadyAccept':
                $message = __('Mechanic already accepted.');
                break;
            case 'AcceptMechanicFailed':
                $message = __('Mechanic accept failed.');
                break;
            case 'InvalidMechanic':
                $message = __('Invalid mechanic.');
                break;
            case 'AcceptChauffeurSuccess':
                $message = __('Chauffeur accepted successfully.');
                break;
            case 'ChauffeurAlreadyAccept':
                $message = __('Chauffeur already accepted.');
                break;
            case 'InvalidChauffeur':
                $message = __('Invalid chauffuer.');
                break;
            case 'AcceptChauffeurFailed':
                $message = __('Chauffeur accept failed.');
                break;
            case 'MechanicReachedSuccess':
                $message = __('Mechanic reached successfully.');
                break;
            case 'MechanicReachedFailed':
                $message = __('Mechanic failed to reach.');
                break;
            case 'ChauffeurReachedSuccess':
                $message = __('Chauffeur reached successfully.');
                break;
            case 'ChauffeurReachedFailed':
                $message = __('Chauffeur reach failed.');
                break;
            case 'ChauffeurStartedSuccess':
                $message = __('Chauffeur started job successfully.');
                break;
            case 'ChauffeurStartedFailed':
                $message = __('Chauffeur started job failed.');
                break;
				
            case 'ChauffeurListedSuccess':
                $message = __('Chauffeur successfully listed.');
                break;
            case 'ChauffeurListedFailed':
                $message = __('Chauffeur list failed.');
                break;
            case 'ChauffeurNotFound':
                $message = __('Chauffeur not found.');
                break;
				
            case 'JobCompletedSuccess':
                $message = __('Job completed successfully.');
                break;
            case 'JobCompletedFailed':
                $message = __('Job not completed');
                break;
            case 'JobExpired':
                $message = __('Job expired');
                break;
            case 'CustomerFeedbackSent':
                $message = __('Feedback Sent Successfully');
                break;
            case 'CustomerFeedbackNotSent':
                $message = __('Feedback send failed. Try Again');
                break;
            case 'AssignMechanicSuccess':
                $message = __('Mechanic assigned successfully.');
                break;
            case 'AssignMechanicFailure':
                $message = __('Mechanic assign failed.');
                break;
            case 'AssignChauffeurSuccess':
                $message = __('Chauffeur assigned successfully.');
                break;
            case 'AssignChauffeurFailure':
                $message = __('Chauffeur assign failed.');
                break;
            case 'MapGaregeSuccess':
                $message = __('Garage mapped successfully.');
                break;
            case 'MapGaregeFailure':
                $message = __('Garage map failed.');
                break;
            case 'MapChauffeurServiceSuccess':
                $message = __('Chauffeur service maped successfully.');
                break;
            case 'MapChauffeurServiceFailure':
                $message = __('Chauffeur service map failed.');
                break;
            case 'TaskListSucccess':
                $message = __('Task listed successfully.');
                break;
            case 'TaskListFailed':
                $message = __('Task list failed.');
                break;
            case 'NoUpdatedTask':
                $message = __('No updated task found.');
                break;
            case 'NoTask':
                $message = __('No task found.');
                break;
            case 'LocationUpdatedSucccess':
                $message = __('Location updated successfully.');
                break;
            case 'LocationUpdatedFailed':
                $message = __('Location update failed.');
                break;
            case 'InvalidMechanic':
                $message = __('Invalid mechanic.');
                break;
            case 'ProviderFound':
                $message = __('Provider found.');
                break;
            case 'SearchProvider':
                $message = __('Searching provider.');
                break;
            case 'SearchProviderFailed':
                $message = __('Searching provider failed.');
                break;
            case 'ProviderReached':
                $message = __('Provider reached successfully.');
                break;

            //chauffeur service
            case 'ChauffeurSuccess':
                $message = __('Chauffeur added successfully.');
                break;
            case 'ChauffeurFailure':
                $message = __('Chauffeur has not been added, Please try again.');
                break;
            case 'VisitFeeSuccess':
                $message = __('Visit fee listed successfully.');
                break;
            case 'VisitFeeFailed':
                $message = __('Visit fee failed.');
                break;
            case 'ListFeedbackSuccess':
                $message = __('Feedback listed successfully.');
                break;
            case 'ListFeedbackFailed':
                $message = __('Feedback list failed.');
                break;
            case 'ViewGarageAdminSuccess':
                $message = __('Garage admin user viewed successfully.');
                break;
            case 'ViewGarageAdminFailed':
                $message = __('Garage admin user view failed.');
                break;
            case 'EditGarageAdminSuccess':
                $message = __('Garage admin user updated successfully.');
                break;
            case 'EditGarageAdminFailed':
                $message = __('Garage admin user update failed.');
                break;
            case 'EditChauffeurAdminSuccess':
                $message = __('Chauffeur admin user updated successfully.');
                break;
            case 'EditChauffeurAdminFailed':
                $message = __('Chauffeur admin user update failed.');
                break;            
            case 'ErrorLogSuccess':
                $message = __('Error log report successfully addded.');
                break;
            case 'ErrorLogFailed':
                $message = __('Error log report has not been added, Please try again.');
                break;
            case 'LocationUpdateSuccess':
                $message = __('Mechanic location successfully updated.');
                break;
            case 'LocationUpdateFailed':
                $message = __('Sorry, Unable to capture your GPS location. If you are indoor, please move out and try again.');
                break;
            case 'MechanicListedSuccess':
                $message = __('Mechanics successfully listed.');
                break;
            case 'MechanicListedFailed':
                $message = __('Mechanic list failed.');
                break;
            case 'MechanicNotFound':
                $message = __('Mechanic not found.');
                break;
            case 'MechanicStatusAdd':
                $message = __('Mechanic status added successfully.');
                break;
            case 'MechanicStatusFailed':
                $message = __('Mechanic status add failed.');
                break;
            case 'ChauffeurStatusAdd':
                $message = __('Chauffeur status added successfully.');
                break;
            case 'ChauffeurStatusFailed':
                $message = __('Chauffeur status add failed.');
                break;
            case 'NotificationListSucccess':
                $message = __('Notifications listed successfully.');
                break;
            case 'NotificationListFailed':
                $message = __('Notifications list failed.');
                break;
            case 'NotificationNotFound':
                $message = __('Notifications not found.');
                break;
            case 'NoUpdatedNotifications':
                $message = __('No updated notifications found.');
                break;
            case 'BreakdownDetailSucccess':
                $message = __('Breakdown details viewed successfully.');
                break;
            case 'BreakdownDetailFailed':
                $message = __('Breakdown details view failed.');
                break;
            case 'MechanicChangePasswordSuccess':
                $message = __('Password changed successfully.');
                break;
            case 'MechanicChangePasswordFailed':
                $message = __('Old password does not match.');
                break;
            
            case 'BookingListSucccess':
                $message = __('Bookings listed successfully.');
                break;
            case 'BookingNotFound':
                $message = __('No booking found.');
                break;
            case 'UpdatedBookingNotFound':
                $message = __('No updated booking found.');
                break;
            case 'MechanicForgotPasswordSuccess':
                $message = __('Your password sent your email successfully.');
                break;
            case 'MechanicForgotPasswordFailed':
                $message = __('Invalid email id.');
                break;
            case 'DeleteMechanicSuccess':
                $message = __('Mechanic has been deleted successfully.');
                break;
            case 'DeleteMechanicFailed':
                $message = __('Mechanic has not been deleted.');
                break;
            case 'GargageStatusAdd':
                $message = __('Garage status added successfully.');
                break;
            case 'GargageStatusFailed':
                $message = __('Garage status add failed.');
                break;
            case 'ChStatusStatusAdd':
                $message = __('Chauffeur service status added successfully.');
                break;
            case 'ChStatusStatusFailed':
                $message = __('Chauffeur service status add failed.');
                break;
            case 'EmailProfileSuccess':
                $message = __('Garage profile sent successfully.');
                break;
            case 'EmailProfileFailed':
                $message = __('No garage found.');
                break;
            case 'ChEmailProfileSuccess':
                $message = __('Chauffeur service profile sent successfully.');
                break;
            case 'ChEmailProfileFailed':
                $message = __('No Chauffeur service found.');
                break;
            case 'AssignSuccess':
                $message = __('Assigned successfully.');
                break;
            case 'AssignFailed':
                $message = __('No request found.');
                break;
            case 'CanceledSuccess':
                $message = __('Request canceled successfully.');
                break;
            case 'CanceledFailure':
                $message = __('Request cancel failed.');
                break;
            case 'InvalidStatus':
                $message = __('Invalid status.');
                break;
            case 'ContentSucccess':
                $message = __('Content listed successfully.');
                break;
            case 'ContentFailure':
                $message = __('Content list failed.');
                break;
            case 'PayementTypeSuccess':
                $message = __('Payment type has been set successfully.');
                break;
            case 'PayementTypeFailure':
                $message = __('Payment type has not been set.');
                break;
            case 'DeclineSuccess':
                $message = __('Declined successfully.');
                break;
            case 'DeclineTypeFailure':
                $message = __('Decline failed.');
                break;
            case 'ListFeedbackSucccess':
                $message = __('Feedback listed successfully.');
                break;
            case 'ListFeedbackNotFound':
                $message = __('Feedback not found.');
                break;
            case 'NoUpdatedListFeedback':
                $message = __('No updated feedback found.');
                break;
            case 'ListFeedbackFailed':
                $message = __('Feedback list failed.');
                break;
            case 'ChangePasswordSuccess':
                $message = __('Password changed successfully.');
                break;
            case 'ChangePasswordFailed':
                $message = __('Password change failed.');
                break;
            case 'OnlinePaymentSuccess':
                $message = __('Selected online payment successfully.');
                break;
            case 'OfflinePaymentSuccess':
                $message = __('Selected offline payment successfully.');
                break;
            case 'PaymentReceivedSuccess':
                $message = __('Payment Received successfully.');
                break;
            case 'PaymentReceivedFailure':
                $message = __('Payment Receive failed.');
                break;
            case 'ForgotPasswordSuccess':
                $message = __('Password sent to your email successfully.');
                break;
            case 'ForgotPasswordFailed':
                $message = __('Invalid email id.');
                break;
            
            case 'CalculateFeeSuccess':
                $message = __('Fee calculated successfully.');
                break;
            case 'CalculateFeeFailure':
                $message = __('Fee calculation failed.');
                break;
            case 'NoUpdatedTask':
                $message = __('No updated task found.');
                break;
            case 'NoUpdatedList':
                $message = __('No updated list found');
                break;
            case 'ChauffeurNotFound':
                $message = __('Chauffeur not found.');
                break;
            case 'DeleteChauffeurSuccess':
                $message = __('Chauffeur deleted successfully.');
                break;
            case 'PromoCodeSuccess':
                $message = __('Promo code verified successfully.');
                break;
            case 'PromoCodeExpired':
                $message = __('Promo code expired.');
                break;
            case 'InvalidPromoCode':
                $message = __('Invalid PromoCode.');
                break;
            case 'PromoCodeLocationNotMatch':
                $message = __('This promocode is invalid in your location.');
                break;
            case 'OfferSuccess':
                $message = __('Offers listed successfully.');
                break;
            case 'OfferFailure':
                $message = __('Offers list failed.');
                break;
            case 'NoUpdatedOffer':
                $message = __('No updated offer found.');
                break;
            case 'RescheduleSuccess':
                $message = __('Rescheduled successfully.');
                break;
            case 'RescheduleFailure':
                $message = __('Reschedule failed.');
                break;
            case 'JobCanceled':
                $message = __('Job has been canceled.');
                break;
            case 'UpdatedAppSuccess':
                $message = __('We have an updated version for you, Please install the lastest version and continue service.');
                break;
            
            case 'PhoneNumberExist':
                $message = __('Phone number already exist, Try with another phone number.');
                break;


            default :
                $message = __('Unknown issue');
        }
        return $message;
    }

}
