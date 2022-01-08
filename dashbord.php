<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectChain</title>
</head>
<body>
    <div>
        <h1>ElectChain</h1>
        <input type="number" name="amount" id="amt">
        <br> <p id="bal"></p>
        <button id="withdraw">Withdraw</button>
        <button id="deposite">deposite</button>
        <button id="balance">Balance</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.0-rc.0/web3.min.js" integrity="sha512-/PTXSvaFzmO4So7Ghyq+DEZOz0sNLU4v1DP4gMOfY3kFu9L/IKoqSHZ6lNl3ZoZ7wT20io3vu/U4IchGcGIhfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var contract;
        var address;
        $(document).ready(function(){
            var web3 = new Web3(Web3.givenProvider);

            address ="0x23EbBf1cE95a84E1c1cfbFfA3E50B9D0cD36699b";
          var abi = [
            {
                "constant": true,
                "inputs": [],
                "name": "getBalance",
                "outputs": [
                    {
                        "name": "",
                        "type": "int256"
                    }
                ],
                "payable": false,
                "stateMutability": "view",
                "type": "function"
            },
            {
                "constant": false,
                "inputs": [
                    {
                        "name": "amt",
                        "type": "int256"
                    }
                ],
                "name": "deposite",
                "outputs": [],
                "payable": false,
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "constant": false,
                "inputs": [
                    {
                        "name": "amt",
                        "type": "int256"
                    }
                ],
                "name": "withdraw",
                "outputs": [],
                "payable": false,
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [],
                "payable": false,
                "stateMutability": "nonpayable",
                "type": "constructor"
            }
        ];
          
        contract = new web3.eth.Contract(abi, address);
            contract.methods.getBalance().call().then(function(bal){
                $("#bal").html(bal);
                console.log(bal);
            });            
        })
        $("#deposite").click( async function(){
            var acc;
            var amt = parseInt($("#amt").val());                
            window.web3 = new Web3(ethereum);
            try{
                await ethereum.enable();
                acc = await web3.eth.getAccounts().then(function(acc){
                    return contract.methods.deposite(amt).send({from:acc[0]});
                }).then(function(tx){
                    console.log(tx);
                });
            }
            catch(err){
                console.log(err);
            }
            
        });
        $("#withdraw").click( async function(){
            var acc;
            var amt = parseInt($("#amt").val());                
            window.web3 = new Web3(ethereum);
            try{
                await ethereum.enable();
                acc = await web3.eth.getAccounts().then(function(acc){
                    return contract.methods.withdraw(amt).send({from:acc[0]});
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