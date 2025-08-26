# Referee Module

## Overview
The Referee module provides a custom content type for managing referees in the job portal. It allows users to create and manage referee entries, including details for two referees per application.

## Features
- Custom field type for referees
- Entity reference for applications
- Form for creating and editing referee details

## File Structure
```
referee_module
├── src
│   ├── Plugin
│   │   └── Field
│   │       └── RefereeField.php
│   ├── Entity
│   │   └── Referee.php
│   └── Form
│       └── RefereeForm.php
├── referee_module.info.yml
├── referee_module.install
├── referee_module.module
└── README.md
```

## Installation Instructions
1. Place the `referee_module` directory in the `modules/custom` directory of your Drupal installation.
2. Enable the module using Drush or through the Drupal admin interface.
   - Using Drush: `drush en referee_module`
3. Clear the cache to ensure the module is recognized by Drupal.
   - Using Drush: `drush cr`

## Usage Guidelines
- Navigate to the content type creation page to add new referees.
- Fill in the details for Referee 1 and Referee 2, including name, designation, email, phone, and address.
- Ensure that email and phone number formats are validated upon submission.

## Dependencies
- Drupal 8 or higher
- Entity API

## Maintainers
- [Your Name] - [Your Email]

For further information, please refer to the module's source code and inline documentation.