// SPDX-License-Identifier: GPL-3.0

pragma solidity >=0.7.0 <0.9.0;

contract primeShip{
    struct Product{
        address creator;
        string productName;
        string productBrand;
        string sentTo;
        uint256 productId;
        string date;
        string location;
    }

    mapping(uint => Product) allProducts;
    mapping(uint => address) brands;
    uint256 items = 0;

    function concat(string memory _a, string memory _b) public pure returns (string memory){
        bytes memory bytes_a = bytes(_a);
        bytes memory bytes_b = bytes(_b);
        string memory length_ab = new string(bytes_a.length + bytes_b.length);
        bytes memory bytes_c = bytes(length_ab);
        uint k = 0;
        for (uint i = 0; i < bytes_a.length; i++) bytes_c[k++] = bytes_a[i];
        for (uint i = 0; i < bytes_b.length; i++) bytes_c[k++] = bytes_b[i];
        return string(bytes_c);
    }

    function newItem(string memory _name, uint _id, string memory _brand) public returns(bool){
        Product memory curItem = Product({creator: msg.sender, productName: _name, productBrand: _brand, sentTo: "", productId: _id, date: "", location: ""});
        //Product memory curItem = Product({creator: msg.sender, productName: _name, productBrand: _brand, productId: _id});
        allProducts[_id] = curItem;
        brands[_id] = msg.sender;
        items = items + 1;
        return true;
    }

    function addDetails(uint _id, string memory _date, string memory _to, string memory _location) public onlyBrand(_id) returns(bool){
        //Product memory curItem = Product({creator: msg.sender, productName: _name, productBrand: _brand, sentTo: _to, productId: _id, date: _date, location: _location});
        allProducts[_id].sentTo = _to;
        allProducts[_id].date = _date;
        allProducts[_id].location = _location;
        return true;
    }

    modifier onlyBrand(uint _id ) {
        require (msg.sender == brands[_id]);
        _;
    }

    function getItems(uint _id) public view returns(string memory){
        string memory output="Product Name: ";
        output=concat(output, allProducts[_id].productName);
        output=concat(output, ", Brand: ");
        output=concat(output, allProducts[_id].productBrand);
        output=concat(output, ", Sent to: ");
        output=concat(output, allProducts[_id].sentTo);
        output=concat(output, ", Manufacture Date: ");
        output=concat(output, allProducts[_id].date);
        output=concat(output, ", Manufacture Location: ");
        output=concat(output, allProducts[_id].location);
        return output;
    }

}