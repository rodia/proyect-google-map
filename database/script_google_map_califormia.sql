-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-07-2013 a las 20:23:39
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `google_map_califormia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collision`
--

CREATE TABLE IF NOT EXISTS `collision` (
  `case_id` varchar(19) NOT NULL,
  `collision_year` int(4) NOT NULL,
  `process_date` int(8) NOT NULL,
  `jurisdiction` int(4) NOT NULL,
  `collision_date` date NOT NULL,
  `collision_time` time NOT NULL,
  `officer_id` varchar(8) NOT NULL,
  `reporting_district` varchar(5) NOT NULL,
  `day_of_week` varchar(1) NOT NULL,
  `chp_shift` varchar(1) NOT NULL,
  `population` varchar(1) NOT NULL,
  `country_city_location` varchar(4) NOT NULL,
  `special_condition` varchar(1) NOT NULL,
  `beat_type` varchar(1) NOT NULL,
  `chp_beat_type` varchar(1) NOT NULL,
  `city_division_lapd` varchar(1) NOT NULL,
  `chp_beat_class` varchar(1) NOT NULL,
  `beat_number` varchar(6) NOT NULL,
  `primary_rd` varchar(50) NOT NULL,
  `secondary_rd` varchar(50) NOT NULL,
  `distance` int(10) NOT NULL,
  `direction` varchar(1) NOT NULL,
  `intersection` varchar(1) NOT NULL,
  `weather_1` varchar(1) NOT NULL,
  `weather_2` varchar(1) NOT NULL,
  `state_highway_indicator` varchar(1) NOT NULL,
  `caltrans_county` varchar(3) NOT NULL,
  `caltrans_district` int(2) NOT NULL,
  `state_route` int(3) NOT NULL,
  `route_suffix` varchar(1) NOT NULL,
  `postmile_prefix` varchar(1) NOT NULL,
  `posmile` int(7) NOT NULL,
  `location_type` varchar(1) NOT NULL,
  `ramp_intersection` varchar(1) NOT NULL,
  `side_of_higway` varchar(1) NOT NULL,
  `tow_away` varchar(1) NOT NULL,
  `collision_severity` varchar(1) NOT NULL,
  `killed_victims` int(3) NOT NULL,
  `injured_victims` int(3) NOT NULL,
  `party_county` int(11) NOT NULL,
  `primary_collision_factor` varchar(1) NOT NULL,
  `pcf_violation_code` varchar(1) NOT NULL,
  `pcf_violation_category` varchar(2) NOT NULL,
  `pcf_violation` int(5) NOT NULL,
  `pcf_violation_subsection` varchar(1) NOT NULL,
  `hit_and_run` varchar(1) NOT NULL,
  `type_of_collision` varchar(1) NOT NULL,
  `motor_vehicle_involved_with` varchar(1) NOT NULL,
  `ped_action` varchar(1) NOT NULL,
  `road_surface` varchar(1) NOT NULL,
  `road_condition_1` varchar(1) NOT NULL,
  `road_condition_2` varchar(1) NOT NULL,
  `lighting` varchar(1) NOT NULL,
  `control_device` varchar(1) NOT NULL,
  `chp_road_type` varchar(1) NOT NULL,
  `pedestrian_collision` varchar(1) NOT NULL,
  `bicycle_collision` varchar(1) NOT NULL,
  `motorcycle_collision` varchar(1) NOT NULL,
  `truck_collision` varchar(1) NOT NULL,
  `not_private_property` varchar(1) NOT NULL,
  `alcohol_involved` varchar(1) NOT NULL,
  `statewide_vehicle_type_at_fault` varchar(1) NOT NULL,
  `chp_vehicle_type_at_fault` varchar(2) NOT NULL,
  `severe_injury_count` int(3) NOT NULL,
  `other_visible_injured_count` int(3) NOT NULL,
  `complaint_of_pain_injury_count` int(3) NOT NULL,
  `pedestrian_killed_count` int(3) NOT NULL,
  `pedestrian_injured_count` int(3) NOT NULL,
  `bicyclist_killed_count` int(3) NOT NULL,
  `bicyclist_injured_count` int(3) NOT NULL,
  `motorcyclist_killed_count` int(3) NOT NULL,
  `motorcyclist_injured_count` int(3) NOT NULL,
  `primary_ramp` varchar(2) NOT NULL,
  `secondary_ramp` varchar(2) NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `party`
--

CREATE TABLE IF NOT EXISTS `party` (
  `case_id` varchar(19) NOT NULL,
  `party_number` int(3) NOT NULL,
  `party_type` varchar(1) NOT NULL,
  `at_fault` varchar(1) NOT NULL,
  `party_sex` varchar(1) NOT NULL,
  `party_age` int(3) NOT NULL,
  `party_sobriety` varchar(1) NOT NULL,
  `party_drug_phisical` varchar(1) NOT NULL,
  `direction_of_travel` varchar(1) NOT NULL,
  `party_safety_equipament_1` varchar(1) NOT NULL,
  `party_safety_equipament_2` varchar(1) NOT NULL,
  `financial_responsibility` varchar(1) NOT NULL,
  `special_information_1` varchar(1) NOT NULL,
  `special_information_2` varchar(1) NOT NULL,
  `special_information_3` varchar(1) NOT NULL,
  `oaf_voiolation_code` varchar(1) NOT NULL,
  `oaf_violation_category` varchar(2) NOT NULL,
  `oaf_vioaltion_section` int(5) NOT NULL,
  `oaf_violation_suffix` varchar(1) NOT NULL,
  `other_associated_factor_1` varchar(1) NOT NULL,
  `other_associated_factor_2` varchar(1) NOT NULL,
  `party_number_killed` int(3) NOT NULL,
  `party_number_injured` int(3) NOT NULL,
  `movement_preceding_collision` varchar(1) NOT NULL,
  `vehicle_year` int(4) NOT NULL,
  `vehicle_make` varchar(50) NOT NULL,
  `statewide_vehicle_type` varchar(1) NOT NULL,
  `chp_vehicle_type_towing` varchar(2) NOT NULL,
  `chp_vehicle_type_towed` varchar(2) NOT NULL,
  `party_race` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `victim`
--

CREATE TABLE IF NOT EXISTS `victim` (
  `case_id` varchar(19) NOT NULL,
  `party_number` varchar(3) NOT NULL,
  `victim_role` varchar(1) NOT NULL,
  `victim_sex` varchar(1) NOT NULL,
  `victim_age` int(3) NOT NULL,
  `victim_degree_of_injured` varchar(1) NOT NULL,
  `victim_seating_position` varchar(1) NOT NULL,
  `victim_safety_equipament_1` varchar(1) NOT NULL,
  `victim_safety_equipament_2` varchar(2) NOT NULL,
  `victim_ejected` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
