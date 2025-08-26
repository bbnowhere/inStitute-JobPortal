# Education Module for Drupal

## Overview
The Education module provides a custom content type called "Education" that allows users to document their educational qualifications from 10th grade to PhD. This module includes various fields to capture detailed information about each qualification.

## Features
- Custom content type: Education
- Fields for:
  - Qualification Name
  - Specialization/Main Subjects
  - University/Institute
  - Country
  - Year of Passing
  - % of Marks (number between 35 to 100)
  - GPA (number between 1 to 10)
  - Certificate Upload

## Installation
1. Place the `education` directory in the `modules/custom` directory of your Drupal installation.
2. Enable the module using Drush or through the Drupal admin interface:
   - Using Drush: `drush en education`
   - Through the admin interface: Navigate to Extend and enable the Education module.

## Usage
Once the module is enabled, you can create and manage "Education" content through the Drupal content creation interface. The fields will allow you to input detailed information about your educational qualifications.

## Maintenance
To update or modify the module, you can edit the respective files in the `education` directory. Ensure to clear the cache after making changes to see the updates reflected in the Drupal interface.

## Support
For any issues or feature requests, please open an issue in the module's repository or contact the module maintainer.