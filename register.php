<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$mobile = $otp = $name = $email = "";
$mobile_err = $otp_err = $name_err = $email_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate mobile number
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter your mobile number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE mobile = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);

            // Set parameters
            $param_mobile = trim($_POST["mobile"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $mobile = trim($_POST["mobile"]);
                } else{
                    $mobile_err = "This mobile number is not registered.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate OTP
    if(empty(trim($_POST["otp"]))){
        $otp_err = "Please enter the OTP.";
    } else{
        $otp = trim($_POST["otp"]);
    }

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check input errors before inserting in database
    if(empty($mobile_err) && empty($otp_err) && empty($name_err) && empty($email_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO registrations (mobile, name, email) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_mobile, $param_name, $param_email);

            // Set parameters
            $param_mobile = $mobile;
            $param_name = $name;
            $param_email = $email;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to payment page
                header("location: payment.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close