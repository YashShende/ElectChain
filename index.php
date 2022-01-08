<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectChain</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand p-1 " href="#"><strong>ElectChain</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">      
      <a class="nav-item nav-link" href="#">VOTE</a>
      <a class="nav-item nav-link" href="#">Voting Info</a>
      <a class="nav-item nav-link btn btn-outline-success my-2 my-sm-0" href="#">Logout</a>
    </div>
  </div>
</nav>

<div class="container-fluid mt-3 p-5 bg-light"> 
  <div class="row">
    <div class="col-sm-6">
    <div class="list-group">
        <p class="h3 p-3">List Of Candidates</p>
    <a href="#" class="list-group-item list-group-item-action ">Bharatiya Janta party  <span class="badge bg-secondary">4</span></a>
    <a href="#" class="list-group-item list-group-item-action">Indian National Congress <span class="badge bg-secondary">3</span></a>
    <a href="#" class="list-group-item list-group-item-action">Aam Admi Party <span class="badge bg-secondary">5</span> </a>
    <a href="#" class="list-group-item list-group-item-action">Shivsena <span class="badge bg-secondary">2</span></a>
    <a href="#" class="list-group-item list-group-item-action ">Bahujan Samaj Party <span class="badge bg-secondary">4</span></a>
    </div>
    </div>
    <div class="col-sm-6">
    <div class="jumbotron">
        <select class="form-select form-select-lg mb-3" id="candidates" aria-label=".form-select-lg example">
            <option selected>Select The Candidate </option>
            <option value="1">Bharatiya Janta party</option>
            <option value="2">Indian National Congress</option>
            <option value="3">Shivsena</option>
            <option value="4">Aam Admi Party</option>            
            <option value="5">Bahujan Samaj Party</option>            
        </select>
    </div>
    <button type="button" id="vote" class="btn p-2 btn-lg btn-outline-success"><strong>Vote</strong></button>
    </div>
  </div>
</div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.0-rc.0/web3.min.js" integrity="sha512-/PTXSvaFzmO4So7Ghyq+DEZOz0sNLU4v1DP4gMOfY3kFu9L/IKoqSHZ6lNl3ZoZ7wT20io3vu/U4IchGcGIhfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>

    if (typeof web3 !== 'undefined') {
        if (web3.currentProvider.isMetaMask === true) {
        console.log('MetaMask is active')
        } else {
        console.log('MetaMask is not active');
        window.alert("MetaMask is not active");
        }
    } else {
        console.log('web3 is not found');
        window.alert("web3 is not found or MetaMask is not active");
    }

    var contract;
    var address;
    $(document).ready(function(){
            var web3 = new Web3(Web3.givenProvider);

        address ="0x5a4D01A8A214d17756D16BA41A88Eb15dD860A60";        
        var abi = [
                    {
                        "constant": false,
                        "inputs": [
                            {
                                "name": "_candidateId",
                                "type": "uint256"
                            }
                        ],
                        "name": "vote",
                        "outputs": [],
                        "payable": false,
                        "stateMutability": "nonpayable",
                        "type": "function"
                    },
                    {
                        "constant": true,
                        "inputs": [],
                        "name": "candidatesCount",
                        "outputs": [
                            {
                                "name": "",
                                "type": "uint256"
                            }
                        ],
                        "payable": false,
                        "stateMutability": "view",
                        "type": "function"
                    },
                    {
                        "constant": true,
                        "inputs": [
                            {
                                "name": "",
                                "type": "uint256"
                            }
                        ],
                        "name": "candidates",
                        "outputs": [
                            {
                                "name": "id",
                                "type": "uint256"
                            },
                            {
                                "name": "name",
                                "type": "string"
                            },
                            {
                                "name": "party",
                                "type": "string"
                            },
                            {
                                "name": "voteCount",
                                "type": "uint256"
                            }
                        ],
                        "payable": false,
                        "stateMutability": "view",
                        "type": "function"
                    },
                    {
                        "constant": true,
                        "inputs": [
                            {
                                "name": "",
                                "type": "address"
                            }
                        ],
                        "name": "voters",
                        "outputs": [
                            {
                                "name": "",
                                "type": "bool"
                            }
                        ],
                        "payable": false,
                        "stateMutability": "view",
                        "type": "function"
                    },
                    {
                        "inputs": [],
                        "payable": false,
                        "stateMutability": "nonpayable",
                        "type": "constructor"
                    },
                    {
                        "anonymous": false,
                        "inputs": [
                            {
                                "indexed": true,
                                "name": "_candidateId",
                                "type": "uint256"
                            }
                        ],
                        "name": "votedEvent",
                        "type": "event"
                    }
                ];          
        contract = new web3.eth.Contract(abi, address);                      
    });   
       
    $('#vote').click(async function(){
        console.log("vote");
        window.web3 = new Web3(ethereum);
        var candidateId = parseInt($('#candidates').val());
        try{
                await ethereum.enable();
                acc = await web3.eth.getAccounts().then(function(acc){
                    return contract.methods.vote(candidateId).send({from:acc[0]});
                }).then(function(tx){
                    console.log(tx);
                });
            }
        catch(err){
                console.log(err);
            }
    });     
      


    </script>

</body>
</html>
