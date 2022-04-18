// SPDX-License-Identifier: GPL-3.0

pragma solidity >=0.7.0 <0.9.0;

import "@openzeppelin/contracts/utils/Strings.sol";
contract primeShip{
    struct Product{
        address creator;
        string productName;
        string productBrand;
        uint256 productId;
    }

    struct Transaction{
        uint256 productId;
        string txn_id;
        string sentTo;
        string location;
        string date;
        string mrp;
    }

    mapping(uint => Product) allProducts;
    mapping(string => Transaction) allTransactions;
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
        Product memory curItem = Product({creator: msg.sender, productName: _name, productBrand: _brand, productId: _id});
        //Product memory curItem = Product({creator: msg.sender, productName: _name, productBrand: _brand, productId: _id});
        allProducts[_id] = curItem;
        brands[_id] = msg.sender;
        items = items + 1;
        return true;
    }

    function addDetails(uint _id, string memory _txn_id, string memory _date, string memory _to, string memory _location, string memory _mrp) public onlyBrand(_id) returns(bool){
        //Product memory curItem = Product({creator: msg.sender, productName: _name, productBrand: _brand, sentTo: _to, productId: _id, date: _date, location: _location});
        Transaction memory curItem = Transaction({productId: _id, txn_id: _txn_id, date: _date, location: _location, sentTo: _to, mrp: _mrp});
        allTransactions[_txn_id] = curItem;
        return true;
    }

    modifier onlyBrand(uint _id ) {
        require (msg.sender == brands[_id]);
        _;
    }

    function getProd(uint _id) public view returns(string memory){
        string memory output = "Product Id: ";
        output = concat(output, Strings.toString(allProducts[_id].productId));
        output = concat(output, " Name: ");
        output = concat(output, allProducts[_id].productName);
        output = concat(output, " Brand: ");
        output = concat(output, allProducts[_id].productBrand);
        return output;
    }

    function getItems(string memory _txn_id) public view returns(string memory){
        string memory output = "<tr>";
        output=concat(output, "<td id=\"td1\"><label for=\"brand\" id=\"lab_brand\">Brand:</label></td>");
        output=concat(output, "<td id=\"td1\"><input type=\"text\" name=\"brand\" id=\"brand\" placeholder=\"");
        output=concat(output, allProducts[allTransactions[_txn_id].productId].productBrand);
        output=concat(output, "\" required readonly></td>");
        output=concat(output, "</tr>");
        output=concat(output, "<tr>");
        output=concat(output, "<td id=\"td1\"><label for=\"prod\" id=\"lab_prod\">Product:</label></td>");
        output=concat(output, "<td id=\"td1\"><input type=\"text\" name=\"prod\" id=\"prod\" placeholder=\"");
        output=concat(output, allProducts[allTransactions[_txn_id].productId].productName);
        output=concat(output, "\" required readonly></td>");
        output=concat(output, "</tr>");
        output=concat(output, "<tr>");
        output=concat(output, "<td id=\"td1\"><label for=\"mrp\" id=\"lab_mrp\">MRP:</label></td>");
        output=concat(output, "<td id=\"td1\"><input type=\"text\" name=\"mrp\" id=\"mrp\" placeholder=\"");
        output=concat(output, allTransactions[_txn_id].mrp);
        output=concat(output, "\" required readonly></td>");
        output=concat(output, "</tr>");
        output=concat(output, "<tr>");
        output=concat(output, "<td id=\"td1\"><label for=\"date\" id=\"lab_date\">Manufacturing Date:</label></td>");
        output=concat(output, "<td id=\"td1\"><input type=\"text\" name=\"date\" id=\"date\" placeholder=\"");
        output=concat(output, allTransactions[_txn_id].date);
        output=concat(output, "\" required readonly></td>");
        output=concat(output, "</tr>");
        output=concat(output, "<tr>");
        output=concat(output, "<td id=\"td1\"><label for=\"loc\" id=\"lab_loc\">Manufacturing Location:</label></td>");
        output=concat(output, "<td id=\"td1\"><input type=\"text\" name=\"loc\" id=\"loc\" placeholder=\"");
        output=concat(output, allTransactions[_txn_id].location);
        output=concat(output, "\" required readonly></td>");
        output=concat(output, "</tr>");
        output=concat(output, "<tr>");
        output=concat(output, "<td id=\"td1\"><label for=\"sent\" id=\"lab_sent\">Store:</label></td>");
        output=concat(output, "<td id=\"td1\"><input type=\"text\" name=\"sent\" id=\"sent\" placeholder=\"");
        output=concat(output, allTransactions[_txn_id].sentTo);
        output=concat(output, "\" required readonly></td>");
        output=concat(output, "</tr>");
        return output;
    }
}