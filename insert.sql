INSERT INTO `users` (`id`, `name`, `username`, `email`, `display`, `type`, `status`, `password`, `fcm_token`, `phone_no`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'uploads/display/display.png', 'Admin', 'Approved', '$2y$14$XgBSikwiR6.BPON6wAAkNOggmjSCcy9c08gQ.eOeSK3kv0CCXeT6C', NULL, NULL, NULL, 'TebBgown1LntnTrApUVFHLazvIgthcfA6q3mAT27h4fR9sYoPtyetAyNNY6L', NULL, NULL),
(2, 'user', 'testuser', 'test@user.com', 'uploads/display/display.png', 'User', 'Approved', '$2y$14$RBhPJFFUkJBkPoCo7jjO0ulhUu1zOTmSubEIZYP0rL2LK1lCIMmke', NULL, '0900 78601', NULL, 'i4coyZ0kcsNkbXoWejHTNg6mtD8E7O5RMpuMnA7B6ezYZM8n1ycuPKdHmEZd', NULL, NULL),
(3, 'company', 'testcompany', 'test@company.com', 'uploads/display/display.png', 'Company', 'Approved', '$2y$14$RBhPJFFUkJBkPoCo7jjO0ulhUu1zOTmSubEIZYP0rL2LK1lCIMmke', NULL, '0900 78601', NULL, NULL, NULL, NULL);

INSERT INTO `companies` (`id`, `description`, `address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'blah blah', 'blah blah', 3, NULL, NULL);

INSERT INTO `profiles` (`id`, `about`, `dob`, `gender`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'blah blah ', '2020-03-18', 'M', 2, NULL, NULL);
