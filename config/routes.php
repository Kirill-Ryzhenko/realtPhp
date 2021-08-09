<?php
return [
    'announcement/rent/[0-9]' => 'Announcement.outputAnnouncement',
    'announcement/sale/[0-9]' => 'Announcement.outputAnnouncement',

    'announcement/add/rent' => 'Announcement.addAnnouncement',
    'announcement/add/sale' => 'Announcement.addAnnouncement',
    'announcement/sale/delete/[0-9]' => 'Announcement.removeAnnouncement',
    'announcement/rent/delete/[0-9]' => 'Announcement.removeAnnouncement',

    'rent' => 'Announcement.allAnnouncement',
    'sale' => 'Announcement.allAnnouncement',

    'admin/support/[0-9]' => 'Admin.supportAnswer',
    'admin/support' => 'Admin.allSupport',

    'user/profile' => 'User.profile',
    'user/edit' => 'User.edit',
    'user/remove' => 'User.remove',
    'user/support' => 'User.support',

    'auth/login' => 'Auth.login',
    'auth/logout' => 'Auth.logout',

    '' => 'Index.index',
];