<?php
namespace Flex;

/**
 * Class UserInterface
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
interface UserInterface {

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return \DateTime
     */
    public function getBirthdate();

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @return string
     */
    public function getStreetNumber();

    /**
     * @return string
     */
    public function getZipcode();

    /**
     * @return string
     */
    public function getCity();

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @return string
     */
    public function getCountryName();
}