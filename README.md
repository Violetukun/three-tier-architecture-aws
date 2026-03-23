# PREMA Hospital Diagnostic Web App Deployment

This repository contains the frontend and backend codebase for the PREMA Hospital Diagnostic Center. It is deployed on AWS using a highly available, secure, and scalable Three-Tier Cloud Architecture. The platform allows medical staff to securely upload patient PDF results to the cloud, and provides a secure portal for patients to view their records using temporary, presigned AWS links.
## Architecture Overview


The application follows the classic three-tier architecture:

1. **Frontend Tier (Presentation Layer)**
   - PHP/HTML/CSS/JavaScript (Custom PREMA Theme)
   - Served by Apache web servers on Amazon EC2
   - Handles patient authentication, secure dashboard rendering, and the staff upload interface.

2. **Backend Tier (Application Layer)**
   - PHP with the AWS SDK (installed via Composer)
   - Generates temporary, secure Presigned URLs for S3 file access.
   - Streams uploaded PDFs directly into Amazon S3.

3. **Database Tier (Data Layer)**
   - Amazon RDS (MySQL): Stores patient metadata, test statuses, and secure S3 file reference keys. Placed in heavily restricted private subnets.
   - Amazon S3: Stores the physical PDF test results. Configured with strict IAM access and automated lifecycle policies.

## Features

- Display messages from the database
- Add new messages to the database
- Basic responsive design

## AWS Infrastructure Components

When deployed on AWS, the infrastructure includes:

- **Web ALB**: Load balancer for distributing traffic to web servers
- **NGINX Servers**: EC2 instances in an auto-scaling group
- **App ALB**: Load balancer for distributing traffic to application servers
- **PHP Servers**: EC2 instances in an auto-scaling group
- **RDS MySQL**: Managed relational database service

## Directory Structure

```
three-tier-architecture-aws/
├── frontend/
│   ├── index.php             # Main landing page
│   ├── online-results.php    # Secure patient login portal
│   ├── dashboard.php         # Patient records table and PDF viewer
│   ├── admin.php             # Staff portal for uploading new results
│   ├── logout.php            # Session destroyer
│   └── images/
│       └── logo.jpg          # PREMA branding
│
├── backend/
│   ├── login.php             # Database verifier and session starter
│   ├── upload.php            # AWS S3 uploader and DB insert logic
│   └── get_result.php        # AWS S3 Presigned URL generator
│
└── README.md
```

## Automated Deployment (Infrastructure as Code)
Instead of manual clicking, this entire environment is deployed using a Zero-Touch Script.

### Prerequisites
- An active AWS Account.
- AWS CLI installed and configured with Administrator privileges.

### Steps

This architecture can be deployed manually via the AWS Console or automatically using the provided Bash deployment script. 

1. **Create VPC** (Virtual Private Cloud)
2. **Create Subnets** (6 Total across 2 Availability Zones)
    1. Public 1a, 1b (For Application Load Balancer & NAT Gateway)
    2. Private Web 1a, 1b (For EC2 Apache/PHP Servers)
    3. Private Database 1a, 1b (For RDS MySQL Database)
3. **Create Route Tables**
    1. Public Route Table
    2. Private Route Table
4. **Associate Route Tables** with their respective subnets
5. **Create Internet Gateway (IGW)**
    1. Attach it to the VPC
6. **Create NAT Gateway** (in Public Subnet 1a)
    1. Allocate and attach an Elastic IP
7. **Add Network Routes** in Route Tables
    1. Public Route Table -> IGW (0.0.0.0/0)
    2. Private Route Table -> NAT Gateway (0.0.0.0/0)
8. **Configure S3 & IAM Security**
    1. Create S3 Bucket for patient PDF results
    2. Apply S3 Lifecycle Rules (Archive to Glacier Deep Archive after 180 days)
    3. Enable S3 Object Lock (WORM compliance for medical records)
    4. Create IAM Role and EC2 Instance Profile for keyless S3 access
9. **Configure AWS CloudTrail** (Audit Logging)
    1. Create dedicated S3 Bucket for security logs
    2. Create CloudTrail Trail and start logging all API activity
10. **Create Security Groups** (Defense in Depth)
    1. ALB Security Group (Allows Inbound HTTP 80 from 0.0.0.0/0)
    2. App Server Security Group (Allows Inbound HTTP 80 *only* from ALB SG)
    3. Database Security Group (Allows Inbound TCP 3306 *only* from App SG)
11. **Provision Database**
    1. Create DB Subnet Group
    2. Provision RDS MySQL Instance (`db.t3.micro`)
12. **Create Application Load Balancer (ALB)**
    1. Create Target Group and enable **Sticky Sessions** (Cookie-based)
    2. Provision ALB across Public Subnets 1a and 1b
    3. Create HTTP Listener routing to the Target Group
13. **Create Compute Resources**
    1. Create EC2 Launch Template with automated User Data script:
        - Installs Apache, PHP, and MySQL extensions
        - Installs AWS SDK via Composer (with memory & headless boot fixes)
        - Injects secure "Ghost Files" for database/S3 credentials
        - Bootstraps MySQL schema and mock patient data
    2. Create Auto Scaling Group (Min: 2, Max: 4) linked to the Launch Template

## Security Considerations

- Network Isolation: Compute and Database tiers reside in private subnets with no inbound internet access.
- Keyless Management: AWS Systems Manager (SSM) is used for server access instead of traditional SSH keys and open Port 22.
- Audit Trails: CloudTrail is actively logging all infrastructure events to a secure, separate S3 bucket.


## License

This project is released under the MIT License.

## Acknowledgements

This project prototype developed for academic purposes only.
