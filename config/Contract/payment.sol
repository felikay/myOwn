// MpesaTransaction.sol
// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract MpesaTransaction {
    struct Transaction {
        uint256 transactionId;
        uint256 amount;
        address sender;
        address receiver;
        uint256 timestamp;
    }

    mapping(uint256 => Transaction) public transactions;
    uint256 public transactionCounter = 0;

    event TransactionRecorded(uint256 transactionId, address indexed sender, address indexed receiver, uint256 amount, uint256 timestamp);

    function recordTransaction(uint256 amount, address receiver) external {
        transactionCounter++;
        transactions[transactionCounter] = Transaction(transactionCounter, amount, msg.sender, receiver, block.timestamp);
        emit TransactionRecorded(transactionCounter, msg.sender, receiver, amount, block.timestamp);
    }
}