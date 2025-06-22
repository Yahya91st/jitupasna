# Super Admin Feature Implementation Guide

## Overview

This document explains the Super Admin role implementation in the JITUPASNA application. The Super Admin role has been created to securely manage admin accounts separately from regular users.

## Key Features

### 1. Role-Based Access Control

Three primary roles with distinct permissions:

- **Super Admin**:
  - Can manage admin accounts only (create, edit, delete)
  - Has permissions: manage admins, manage categories, view forms, edit forms, manage disasters
  - Cannot manage regular users
  
- **Admin**:
  - Can manage regular user accounts only (create, edit, delete)
  - Has permissions: manage users, manage categories, view forms, edit forms, manage disasters
  - Cannot manage other admins or super admins
  
- **User**:
  - Regular application user with restricted permissions
  - Has permission: view forms
  - Cannot perform administrative actions

### 2. UI Customization by Role

- Super Admin sees only admin accounts in the user management screen
- Admin sees only regular user accounts in the user management screen
- Sidebar menu shows appropriate user management link for each role
- Each role has access to create only users of appropriate subordinate roles

### 3. Implementation Details

- **RoleAccess middleware**: Flexible middleware for checking multiple role permissions
- **Conditional form controls**: User management forms adapt to the current user's role
- **Separate access paths**: Super Admin and Admin have separate views and logic for user management

## How to Use

### Super Admin Access

1. Login with the default Super Admin account:
   - Email: super-admin@example.com
   - Password: password

2. Navigate to User Management (now labeled "Manajemen Admin")
   - You will only see and be able to manage admin accounts
   - You cannot see or manage regular user accounts
  
3. When creating a new user, you can only assign the Admin role

### Admin Access

1. Login with an Admin account:
   - Email: admin@example.com
   - Password: password

2. Navigate to User Management (labeled "Manajemen Pengguna")
   - You will only see and be able to manage regular user accounts
   - You cannot see or manage admin or super admin accounts
  
3. When creating a new user, you can only assign the User role

## Validation & Error Handling

- Attempting to create users with unauthorized roles will show an error message
- Attempting to delete your own account is prevented with an error message
- Appropriate 403 Forbidden responses if trying to access unauthorized resources

## Testing

You can test the role permissions with the Artisan command:

```bash
php artisan roles:test
```

This will show all permissions assigned to each role and test the default accounts.
