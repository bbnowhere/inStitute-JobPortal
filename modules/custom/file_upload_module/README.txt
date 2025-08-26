File Upload Module
------------------

This module creates a "File Upload" content type with the following fields:

- PAN/Passport/DL/Voter ID (PDF, max 5MB, mandatory)
- Resume (PDF, max 5MB, mandatory)
- Upload Experience Certificates (PDF, max 5MB)
- Reservation Certificate / Additional information (PDF, max 5MB)
- Application (entity reference)
- Transaction details of the application fee payment (long text)
- No Objection Certificate (list field: I will upload NOC., I shall produce..., Not applicable)
- No Objection Certificate File (PDF, max 5MB; shown if "I will upload NOC." is selected)
- Application (entity reference)

Fields are created automatically when the module is installed.