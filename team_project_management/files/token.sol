// SPDX-License-Identifier: MIT
pragma solidity ^0.8.20;

// Import chuẩn ERC20 và Ownable từ OpenZeppelin
import "@openzeppelin/contracts/token/ERC20/ERC20.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract MyToken is ERC20, Ownable {
    constructor(uint256 initialSupply) ERC20("MyToken", "MTK") Ownable(msg.sender) {
        // Mint token cho người deploy
        _mint(msg.sender, initialSupply * 10 ** decimals());
    }

    // Owner có thể mint thêm token
    function mint(address to, uint256 amount) external onlyOwner {
        _mint(to, amount);
    }
}

