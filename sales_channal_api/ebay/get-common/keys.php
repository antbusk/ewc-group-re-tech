<?php
/*  © 2013 eBay Inc., All Rights Reserved */ 
/* Licensed under CDDL 1.0 -  http://opensource.org/licenses/cddl1.php */
    //show all errors
    error_reporting(E_ALL);

    // these keys can be obtained by registering at http://developer.ebay.com
    
    $production         = true;   // toggle to true if going against production
    $compatabilityLevel = 717;    // eBay API version
    
    if ($production) {
        $devID = '8c9eb70c-83cd-431f-87ae-616a6dce2661';   // these prod keys are different from sandbox keys
        $appID = 'AnthonyE-1b20-4060-8a48-a07dedd38654';
        $certID = '1eb4dc48-54f0-40b9-9c80-1df14efd522c';
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.ebay.com/ws/api.dll';      // server URL different for prod and sandbox
        //the token representing the eBay user to assign the call with
        $userToken = 'AgAAAA**AQAAAA**aAAAAA**ZfABVQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AEkYOgDpGDqQWdj6x9nY+seQ**CIoCAA**AAMAAA**DPrTROGqgDteRchjtZ5lM2fADhq1sSbUL38FduVVaFsUVhjCPVJbS0xtsRggag1PgZQswezQiysemSGkMytVLuoA5ZmIs4oGhx/WPAbWqQB4mceHaYfJFJh6ptXdYXuWJ9SxEX7bT3zqzRPlaXTXpDhEaBbqYwoSSnLI/kiVk4Jo4hILu77TEThs+Qe7ju3t4A5psRXXCRR0o7yKms8ZTtgyQVcSWHN9o86+miRk4czUfTEuMIUBwxCYN7Af019EpLGPB1S3sV6PBculizJO7oIouxXhEDpHLjPDQ0M+8ZiBrz+KRtrHhogZdvaJJ2E/kIjTHMBqum2omenYlI0ePd+Wvnrj+IS47OATCu+z5dq8Zh1RSdjdqmnGfFi/UxkislBSJjTQmmxfUjKu/4WRpCW1A0NwA8u8HYrCyd8YHElNp6xOmrGHo15wC3MkfQqbNuQsoHzWYQ17LEgifz9Yb/i4R4GZUyvvFILmuyICamMeKN0OFiX/fT/lK1jjowEr+KK8RiitVerMqiMO7c4Ij3pluMzQE+Zu/jmBX4QDrwDo145yOgraIHbwFM1s0MTSQAgEGb7KEB4oxQqN7HThQ4tudJeIqjehkZRNXM4hNJjKQXnktjL5sMKGtxgAKIMuZqsh0kcmKVI6MVT7tFO/SJOyXXxFvUhw8N1P7I/P08spx7LLWzCHw2ltI6H+kccgEKda/BGyEOm5kYMwVq/8/1KdBLi3tVO4a5O40dhbWWlyeYUvrfwqye+kXX6KNSA0';          
    } else {  
        // sandbox (test) environment
        $devID = 'xxxxxxxx';   // these SB keys are different from prod keys
        $appID = 'xxxxxxxxx';
        $certID = 'xxxxxxxxxxxxxx';
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.sandbox.ebay.com/ws/api.dll';
        // the token representing the eBay user to assign the call with
        // this token is a long string - don't insert new lines - different from prod token
        $userToken = '*************';          
    }
    
    
?>