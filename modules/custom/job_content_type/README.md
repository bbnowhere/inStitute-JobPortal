# Job Content Type Module

This module defines a custom content type for "Job" in your application. It includes a custom field type for job-related data and provides a structured way to manage job postings.

## Installation

1. Download the module and place it in the appropriate directory of your application.
2. Enable the module through the administration interface or using Drush.

## Usage

Once the module is enabled, you can create and manage job postings using the "Job" content type. The following fields are included:

- **Advertisement Number**: A unique identifier for the job posting.
- **Job Title**: The title of the job position.
- **Employment Type**: The type of employment (e.g., Full-time, Part-time, Contract).
- **Job Description**: A detailed description of the job responsibilities and requirements.
- **Location**: The geographical location of the job.
- **Salary**: The salary range for the position.

## Custom Field Type

The module includes a custom field type defined in `src/Plugin/Field/JobField.php`, which allows for additional functionality and customization of job-related fields.

## Contributing

If you would like to contribute to this project, please submit a pull request or open an issue for discussion.

## License

This project is licensed under the MIT License. See the LICENSE file for more details.