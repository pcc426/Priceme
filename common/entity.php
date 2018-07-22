<?php
include_once("init.php");

class User
{
    private $userID;
    private $userName;
    private $password;
    private $userCategory;

    /**
     * user constructor.
     * @param $userID
     * @param $userName
     * @param $password
     * @param $userCategory
     */
    public function __construct($userID, $userName, $password, $userCategory)
    {
        $this->userID = $userID;
        $this->userName = $userName;
        $this->password = $password;
        $this->userCategory = $userCategory;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserCategory()
    {
        return $this->userCategory;
    }

    /**
     * @param mixed $userCategory
     */
    public function setUserCategory($userCategory)
    {
        $this->userCategory = $userCategory;
    }
}

class Customer_Info
{
    private $customerName;
    private $userID;
    private $customerEmail;
    private $customerTel;
    private $customerIcon;

    public function __construct($customerName, $userID, $customerEmail, $customerTel, $customerIcon)
    {
        $this->$customerName = $customerName;
        $this->$userID = $userID;
        $this->$customerEmail = $customerEmail;
        $this->$customerTel = $customerTel;
        $this->$customerIcon = $customerIcon;

    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @param mixed $customerEmail
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return mixed
     */
    public function getCustomerTel()
    {
        return $this->customerTel;
    }

    /**
     * @param mixed $customerTel
     */
    public function setCustomerTel($customerTel)
    {
        $this->customerTel = $customerTel;
    }

    /**
     * @return mixed
     */
    public function getCustomerIcon()
    {
        return $this->customerIcon;
    }

    /**
     * @param mixed $customerIcon
     */
    public function setCustomerIcon($customerIcon)
    {
        $this->customerIcon = $customerIcon;
    }



}

class Vendor_Info{
    private $userID;
    private $vendorTypeID;
    private $vendorName;
    private $vendorLogo;
    private $vendorImage;
    private $vendorTel;
    private $vendorAddress;
    private $vendorDescription;
    private $vendorPeriod;

    /**
     * Vendor_Info constructor.
     * @param $userID
     * @param $vendorTypeID
     * @param $vendorName
     * @param $vendorLogo
     * @param $vendorImage
     * @param $vendorTel
     * @param $vendorAddress
     * @param $vendorDescription
     * @param $vendorPeriod
     */
    public function __construct($userID, $vendorTypeID, $vendorName, $vendorLogo, $vendorImage, $vendorTel, $vendorAddress, $vendorDescription, $vendorPeriod)
    {
        $this->userID = $userID;
        $this->vendorTypeID = $vendorTypeID;
        $this->vendorName = $vendorName;
        $this->vendorLogo = $vendorLogo;
        $this->vendorImage = $vendorImage;
        $this->vendorTel = $vendorTel;
        $this->vendorAddress = $vendorAddress;
        $this->vendorDescription = $vendorDescription;
        $this->vendorPeriod = $vendorPeriod;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getVendorTypeID()
    {
        return $this->vendorTypeID;
    }

    /**
     * @param mixed $vendorTypeID
     */
    public function setVendorTypeID($vendorTypeID)
    {
        $this->vendorTypeID = $vendorTypeID;
    }

    /**
     * @return mixed
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }

    /**
     * @param mixed $vendorName
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;
    }

    /**
     * @return mixed
     */
    public function getVendorLogo()
    {
        return $this->vendorLogo;
    }

    /**
     * @param mixed $vendorLogo
     */
    public function setVendorLogo($vendorLogo)
    {
        $this->vendorLogo = $vendorLogo;
    }

    /**
     * @return mixed
     */
    public function getVendorImage()
    {
        return $this->vendorImage;
    }

    /**
     * @param mixed $vendorImage
     */
    public function setVendorImage($vendorImage)
    {
        $this->vendorImage = $vendorImage;
    }

    /**
     * @return mixed
     */
    public function getVendorTel()
    {
        return $this->vendorTel;
    }

    /**
     * @param mixed $vendorTel
     */
    public function setVendorTel($vendorTel)
    {
        $this->vendorTel = $vendorTel;
    }

    /**
     * @return mixed
     */
    public function getVendorAddress()
    {
        return $this->vendorAddress;
    }

    /**
     * @param mixed $vendorAddress
     */
    public function setVendorAddress($vendorAddress)
    {
        $this->vendorAddress = $vendorAddress;
    }

    /**
     * @return mixed
     */
    public function getVendorDescription()
    {
        return $this->vendorDescription;
    }

    /**
     * @param mixed $vendorDescription
     */
    public function setVendorDescription($vendorDescription)
    {
        $this->vendorDescription = $vendorDescription;
    }

    /**
     * @return mixed
     */
    public function getVendorPeriod()
    {
        return $this->vendorPeriod;
    }

    /**
     * @param mixed $vendorPeriod
     */
    public function setVendorPeriod($vendorPeriod)
    {
        $this->vendorPeriod = $vendorPeriod;
    }


}

class VendorType{
    private $vendorTypeID;
    private $typeName;

    /**
     * VendorType constructor.
     * @param $vendorTypeID
     * @param $typeName
     */
    public function __construct($vendorTypeID, $typeName)
    {
        $this->vendorTypeID = $vendorTypeID;
        $this->typeName = $typeName;
    }

    /**
     * @return mixed
     */
    public function getVendorTypeID()
    {
        return $this->vendorTypeID;
    }

    /**
     * @param mixed $vendorTypeID
     */
    public function setVendorTypeID($vendorTypeID)
    {
        $this->vendorTypeID = $vendorTypeID;
    }

    /**
     * @return mixed
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param mixed $typeName
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
    }
}

class Order
{
    private $orderID;
    private $productID;
    private $promotionID;
    private $userID;
    private $paymentChannel;
    private $creditCardType = "";
    private $creditCardNo = "";
    private $creditCardSecurityCode = "";
    private $creditCardHolderName = "";
    private $creditCardExpiryDate = "";
    private $checkNo = "";
    private $orderTime = "";
    private $orderPrice = "";
    private $productScore = "";
    private $commentContent = "";
    private $vendorScore = "";
    private $inventoryRate = "";
    private $effectTimeLeft = "";

    /**
     * Order constructor.
     * @param $orderID
     * @param $productID
     * @param $promotionID
     * @param $userID
     * @param $paymentChannel
     * @param string $creditCardType
     * @param string $creditCardNo
     * @param string $creditCardSecurityCode
     * @param string $creditCardHolderName
     * @param string $creditCardExpiryDate
     * @param string $checkNo
     * @param string $orderTime
     * @param string $orderPrice
     * @param string $productScore
     * @param string $commentContent
     * @param string $vendorScore
     * @param string $inventoryRate
     * @param string $effectTimeLeft
     */
    public function __construct($orderID, $productID, $promotionID, $userID, $paymentChannel, $creditCardType, $creditCardNo, $creditCardSecurityCode, $creditCardHolderName, $creditCardExpiryDate, $checkNo, $orderTime, $orderPrice, $productScore, $commentContent, $vendorScore, $inventoryRate, $effectTimeLeft)
    {
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->promotionID = $promotionID;
        $this->userID = $userID;
        $this->paymentChannel = $paymentChannel;
        $this->creditCardType = $creditCardType;
        $this->creditCardNo = $creditCardNo;
        $this->creditCardSecurityCode = $creditCardSecurityCode;
        $this->creditCardHolderName = $creditCardHolderName;
        $this->creditCardExpiryDate = $creditCardExpiryDate;
        $this->checkNo = $checkNo;
        $this->orderTime = $orderTime;
        $this->orderPrice = $orderPrice;
        $this->productScore = $productScore;
        $this->commentContent = $commentContent;
        $this->vendorScore = $vendorScore;
        $this->inventoryRate = $inventoryRate;
        $this->effectTimeLeft = $effectTimeLeft;
    }




    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * @param mixed $orderID
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param mixed $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getPromotionID()
    {
        return $this->promotionID;
    }

    /**
     * @param mixed $promotionID
     */
    public function setPromotionID($promotionID)
    {
        $this->promotionID = $promotionID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getPaymentChannel()
    {
        return $this->paymentChannel;
    }

    /**
     * @param mixed $paymentChannel
     */
    public function setPaymentChannel($paymentChannel)
    {
        $this->paymentChannel = $paymentChannel;
    }

    /**
     * @return string
     */
    public function getCreditCardType()
    {
        return $this->creditCardType;
    }

    /**
     * @param string $creditCardType
     */
    public function setCreditCardType($creditCardType)
    {
        $this->creditCardType = $creditCardType;
    }

    /**
     * @return string
     */
    public function getCreditCardNo()
    {
        return $this->creditCardNo;
    }

    /**
     * @param string $creditCardNo
     */
    public function setCreditCardNo($creditCardNo)
    {
        $this->creditCardNo = $creditCardNo;
    }

    /**
     * @return string
     */
    public function getCreditCardSecurityCode()
    {
        return $this->creditCardSecurityCode;
    }

    /**
     * @param string $creditCardSecurityCode
     */
    public function setCreditCardSecurityCode($creditCardSecurityCode)
    {
        $this->creditCardSecurityCode = $creditCardSecurityCode;
    }

    /**
     * @return string
     */
    public function getCreditCardHolderName()
    {
        return $this->creditCardHolderName;
    }

    /**
     * @param string $creditCardHolderName
     */
    public function setCreditCardHolderName($creditCardHolderName)
    {
        $this->creditCardHolderName = $creditCardHolderName;
    }

    /**
     * @return string
     */
    public function getCreditCardExpiryDate()
    {
        return $this->creditCardExpiryDate;
    }

    /**
     * @param string $creditCardExpiryDate
     */
    public function setCreditCardExpiryDate($creditCardExpiryDate)
    {
        $this->creditCardExpiryDate = $creditCardExpiryDate;
    }

    /**
     * @return string
     */
    public function getCheckNo()
    {
        return $this->checkNo;
    }

    /**
     * @param string $checkNo
     */
    public function setCheckNo($checkNo)
    {
        $this->checkNo = $checkNo;
    }

    /**
     * @return string
     */
    public function getOrderTime()
    {
        return $this->orderTime;
    }

    /**
     * @param string $orderTime
     */
    public function setOrderTime($orderTime)
    {
        $this->orderTime = $orderTime;
    }

    /**
     * @return string
     */
    public function getOrderPrice()
    {
        return $this->orderPrice;
    }

    /**
     * @param string $orderPrice
     */
    public function setOrderPrice($orderPrice)
    {
        $this->orderPrice = $orderPrice;
    }

    /**
     * @return string
     */
    public function getProductScore()
    {
        return $this->productScore;
    }

    /**
     * @param string $productScore
     */
    public function setProductScore($productScore)
    {
        $this->productScore = $productScore;
    }

    /**
     * @return string
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * @param string $commentContent
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }

    /**
     * @return string
     */
    public function getVendorScore()
    {
        return $this->vendorScore;
    }

    /**
     * @param string $vendorScore
     */
    public function setVendorScore($vendorScore)
    {
        $this->vendorScore = $vendorScore;
    }

    /**
     * @return string
     */
    public function getInventoryRate()
    {
        return $this->inventoryRate;
    }

    /**
     * @param string $inventoryRate
     */
    public function setInventoryRate($inventoryRate)
    {
        $this->inventoryRate = $inventoryRate;
    }

    /**
     * @return string
     */
    public function getEffectTimeLeft()
    {
        return $this->effectTimeLeft;
    }

    /**
     * @param string $effectTimeLeft
     */
    public function setEffectTimeLeft($effectTimeLeft)
    {
        $this->effectTimeLeft = $effectTimeLeft;
    }

}

class Promotion{
    private $promotionID;
    private $productID;
    private $lowestPrice;
    private $highestPrice;
    private $effectTime;
    private $expireTime;
    private $effectAmount;
    private $soldAmount;

    /**
     * Promotion constructor.
     * @param $promotionID
     * @param $productID
     * @param $lowestPrice
     * @param $highestPrice
     * @param $effectTime
     * @param $expireTime
     * @param $effectAmount
     * @param $soldAmount
     */
    public function __construct($promotionID, $productID, $lowestPrice, $highestPrice, $effectTime, $expireTime, $effectAmount, $soldAmount)
    {
        $this->promotionID = $promotionID;
        $this->productID = $productID;
        $this->lowestPrice = $lowestPrice;
        $this->highestPrice = $highestPrice;
        $this->effectTime = $effectTime;
        $this->expireTime = $expireTime;
        $this->effectAmount = $effectAmount;
        $this->soldAmount = $soldAmount;
    }

    /**
     * @return mixed
     */
    public function getPromotionID()
    {
        return $this->promotionID;
    }

    /**
     * @param mixed $promotionID
     */
    public function setPromotionID($promotionID)
    {
        $this->promotionID = $promotionID;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param mixed $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getLowestPrice()
    {
        return $this->lowestPrice;
    }

    /**
     * @param mixed $lowestPrice
     */
    public function setLowestPrice($lowestPrice)
    {
        $this->lowestPrice = $lowestPrice;
    }

    /**
     * @return mixed
     */
    public function getHighestPrice()
    {
        return $this->highestPrice;
    }

    /**
     * @param mixed $highestPrice
     */
    public function setHighestPrice($highestPrice)
    {
        $this->highestPrice = $highestPrice;
    }

    /**
     * @return mixed
     */
    public function getEffectTime()
    {
        return $this->effectTime;
    }

    /**
     * @param mixed $effectTime
     */
    public function setEffectTime($effectTime)
    {
        $this->effectTime = $effectTime;
    }

    /**
     * @return mixed
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * @param mixed $expireTime
     */
    public function setExpireTime($expireTime)
    {
        $this->expireTime = $expireTime;
    }

    /**
     * @return mixed
     */
    public function getEffectAmount()
    {
        return $this->effectAmount;
    }

    /**
     * @param mixed $effectAmount
     */
    public function setEffectAmount($effectAmount)
    {
        $this->effectAmount = $effectAmount;
    }

    /**
     * @return mixed
     */
    public function getSoldAmount()
    {
        return $this->soldAmount;
    }

    /**
     * @param mixed $soldAmount
     */
    public function setSoldAmount($soldAmount)
    {
        $this->soldAmount = $soldAmount;
    }



}

class Product
{
    private $productID;
    private $userID;
    private $productName;
    private $productImage;
    private $productDescription;
    private $inventoryAmount;
    private $soldAmount;
    private $costPrice;
    private $initialPrice;
    private $currentPrice;

    /**
     * Product constructor.
     * @param $productID
     * @param $userID
     * @param $productName
     * @param $productImage
     * @param $productDescription
     * @param $inventoryAmount
     * @param $soldAmount
     * @param $costPrice
     * @param $initialPrice
     * @param $currentPrice
     */
    public function __construct($productID, $userID, $productName, $productImage, $productDescription, $inventoryAmount, $soldAmount, $costPrice, $initialPrice, $currentPrice)
    {
        $this->productID = $productID;
        $this->userID = $userID;
        $this->productName = $productName;
        $this->productImage = $productImage;
        $this->productDescription = $productDescription;
        $this->inventoryAmount = $inventoryAmount;
        $this->soldAmount = $soldAmount;
        $this->costPrice = $costPrice;
        $this->initialPrice = $initialPrice;
        $this->currentPrice = $currentPrice;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param mixed $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * @param mixed $productImage
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @param mixed $productDescription
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
    }

    /**
     * @return mixed
     */
    public function getInventoryAmount()
    {
        return $this->inventoryAmount;
    }

    /**
     * @param mixed $inventoryAmount
     */
    public function setInventoryAmount($inventoryAmount)
    {
        $this->inventoryAmount = $inventoryAmount;
    }

    /**
     * @return mixed
     */
    public function getSoldAmount()
    {
        return $this->soldAmount;
    }

    /**
     * @param mixed $soldAmount
     */
    public function setSoldAmount($soldAmount)
    {
        $this->soldAmount = $soldAmount;
    }

    /**
     * @return mixed
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * @param mixed $costPrice
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;
    }

    /**
     * @return mixed
     */
    public function getInitialPrice()
    {
        return $this->initialPrice;
    }

    /**
     * @param mixed $initialPrice
     */
    public function setInitialPrice($initialPrice)
    {
        $this->initialPrice = $initialPrice;
    }

    /**
     * @return mixed
     */
    public function getCurrentPrice()
    {
        return $this->currentPrice;
    }

    /**
     * @param mixed $currentPrice
     */
    public function setCurrentPrice($currentPrice)
    {
        $this->currentPrice = $currentPrice;
    }




}

class OrderDetail4Display
{
    private $productName;
    private $image;
    private $description;
    private $price;
    private $productID;

    /**
     * OrderDetail4Display constructor.
     * @param $productName
     * @param $image
     * @param $description
     * @param $price
     * @param $productID
     */
    public function __construct($productName, $image, $description, $price, $productID)
    {
        $this->productName = $productName;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param mixed $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }




}
?>