let primeShip = artifacts.require('./primeShip.sol');

let primeShipTest;

contract('PrimeShip Contract', function (accounts){
    //Positive Test 1 
    it("Contract deployment", function() {
        return primeShip.deployed().then(function (instance) {
        primeShipTest = instance;
        assert(primeShipTest !== undefined, 'PrimeShip contract should be defined');
        });
    });
});

