<?php

namespace Vigo5190\Smexp\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registration
 */
class Registration {
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $somedata1;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $second_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var \DateTime
     */
    private $birthday;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $imei;

    /**
     * @var string
     */
    private $model;

    /**
     * @var \DateTime
     */
    private $date_buy;

    /**
     * @var string
     */
    private $img_path;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set somedata1
     *
     * @param string $somedata1
     * @return Registration
     */
    public function setSomedata1($somedata1) {
        $this->somedata1 = $somedata1;

        return $this;
    }

    /**
     * Get somedata1
     *
     * @return string
     */
    public function getSomedata1() {
        return $this->somedata1;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Registration
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set second_name
     *
     * @param string $secondName
     * @return Registration
     */
    public function setSecondName($secondName) {
        $this->second_name = $secondName;

        return $this;
    }

    /**
     * Get second_name
     *
     * @return string
     */
    public function getSecondName() {
        return $this->second_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Registration
     */
    public function setLastName($lastName) {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Registration
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Registration
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Registration
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Registration
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set imei
     *
     * @param string $imei
     * @return Registration
     */
    public function setImei($imei) {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return string
     */
    public function getImei() {
        return $this->imei;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Registration
     */
    public function setModel($model) {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Set date_buy
     *
     * @param \DateTime $dateBuy
     * @return Registration
     */
    public function setDateBuy($dateBuy) {
        $this->date_buy = $dateBuy;

        return $this;
    }

    /**
     * Get date_buy
     *
     * @return \DateTime
     */
    public function getDateBuy() {
        return $this->date_buy;
    }

    /**
     * Set img_path
     *
     * @param string $imgPath
     * @return Registration
     */
    public function setImgPath($imgPath) {
        $this->img_path = $imgPath;

        return $this;
    }

    /**
     * Get img_path
     *
     * @return string
     */
    public function getImgPath() {
        return $this->img_path;
    }
}
