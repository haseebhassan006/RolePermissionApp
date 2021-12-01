<?php

namespace App\Helpers;

class HelperComponent
{

    public static function SideBar()
    {
        return [
            [
                "heading" => "Menu",
            ],
            [
                "single_link" => setSingleLink("dashboard", "home", "dashboard-view", "/"),
            ],
            [
                "heading" => "Management",
            ],

            [

                "menu" => [
                    "title" => 'User Management',
                    "icon" => "user",
                    "sub_menu" => [
                        setSubMenu(
                            "Users",
                            null,
                            "users-view",
                            "/users",
                        ),
                        setSubMenu(
                            "Roles",
                            null,
                            "roles-view",
                            "/roles",
                        ),
                        setSubMenu(
                            "Permissions",
                            null,
                            "permissions-view",
                            "/permissions",
                        ),

                    ]

                ],

            ],

            // [
            //     "heading" => "Apps",
            // ],
            // [

            //     "menu" => [
            //         "title" => 'Ecommerce',
            //         "icon" => "shopping-cart",
            //         "sub_menu" => [
            //             setSubMenu(
            //                 "Categories",
            //                 null,
            //                 "categories-view",
            //                 "/categories",
            //             ),
            //             setSubMenu(
            //                 "Products",
            //                 null,
            //                 "products-view",
            //                 "/products",
            //             ),

            //             setSubMenu(
            //                 "Orders",
            //                 null,
            //                 "orders-view",
            //                 "/orders",
            //             ),

            //         ]

            //     ],

            // ],
        //      [

        //         "menu" => [
        //             "title" => 'Orders',
        //             "icon" => "shopping-cart",
        //             "sub_menu" => [
        //                 setSubMenu(
        //                     "New Orders",
        //                     null,
        //                     "new-order-view",
        //                     "/new-order",
        //                 ),
        //                 setSubMenu(
        //                     "Accepted Orders",
        //                     null,
        //                     "accepted-orders-view",
        //                     "/accepted-orders",
        //                 ),

        //                 setSubMenu(
        //                     "Pending Orders",
        //                     null,
        //                     "pending-orders-view",
        //                     "/pending-orders",
        //                 ),
        //                 setSubMenu(
        //                     "Pre Orders",
        //                     null,
        //                     "pre-orders-view",
        //                     "/pre-orders",
        //                 ),
        //                 setSubMenu(
        //                     "Declined Orders",
        //                     null,
        //                     "declined-orders-view",
        //                     "/declined-orders",
        //                 ),
        //                setSubMenu(
        //                     "Delivered Orders",
        //                     null,
        //                     "delivered-orders-view",
        //                     "/Delivered-orders",
        //                 ),

        //             ]

        //         ],

        //       ],
        //       [

        //         "menu" => [
        //             "title" => 'Members',
        //             "icon" => "users",
        //             "sub_menu" => [
        //                 setSubMenu(
        //                     "New Members",
        //                     null,
        //                     "new-members-view",
        //                     "/new-members",
        //                 ),
        //                 setSubMenu(
        //                     "Messages",
        //                     null,
        //                     "Messages-view",
        //                     "/member/messages",
        //                 ),

        //                 setSubMenu(
        //                     "Verifications Members",
        //                     null,
        //                     "verifications-members-view",
        //                     "/members/verifications",
        //                 ),
        //                 setSubMenu(
        //                     "Gold Members",
        //                     null,
        //                     "gold-members-view",
        //                     "/gold-members",
        //                 ),
        //                setSubMenu(
        //                     "Queries & Alerts",
        //                     null,
        //                     "queries-members-view",
        //                     "/queries-members",
        //                 ),

        //             ]

        //         ],

        //       ],
        //      [

        //         "menu" => [
        //             "title" => 'Customers',
        //             "icon" => "users",
        //             "sub_menu" => [
        //                 setSubMenu(
        //                     "New Customers",
        //                     null,
        //                     "new-customers-view",
        //                     "/new-customers",
        //                 ),
        //                 setSubMenu(
        //                     "Messages",
        //                     null,
        //                     "customers-messages-view",
        //                     "/customers/messages",
        //                 ),

        //                 setSubMenu(
        //                     "Complaints",
        //                     null,
        //                     "complaints-customers-view",
        //                     "/customers/complaints",
        //                 ),

        //             ]

        //         ],

        //       ],
        //      [

        //         "menu" => [
        //             "title" => 'Subscribers',
        //             "icon" => "credit-card",
        //             "sub_menu" => [
        //                 setSubMenu(
        //                     "New Subscribers",
        //                     null,
        //                     "new-customers-view",
        //                     "/new-customers",
        //                 ),
        //                 setSubMenu(
        //                     "Current Subscribers",
        //                     null,
        //                     "customers-messages-view",
        //                     "/customers/messages",
        //                 ),

        //                 setSubMenu(
        //                     "Recurring Payments",
        //                     null,
        //                     "complaints-customers-view",
        //                     "/customers/complaints",
        //                 ),
        //                 setSubMenu(
        //                     "Cancelled Subscription",
        //                     null,
        //                     "complaints-customers-view",
        //                     "/customers/complaints",
        //                 ),
        //                 setSubMenu(
        //                     "Complaints",
        //                     null,
        //                     "complaints-customers-view",
        //                     "/customers/complaints",
        //                 ),

        //             ]

        //         ],

        //       ],
        //     [
        //         "heading" => "Content",
        //     ],
        //     [
        //         "single_link" => setSingleLink("Services", "layers", "services-view", "/services"),
        //     ],
        //     [
        //         "heading" => "Tool",
        //     ],
        //     [

        //         "menu" => [
        //             "title" => 'Settings',
        //             "icon" => "settings",
        //             "sub_menu" => [
        //                 setSubMenu(
        //                     "Profile",
        //                     null,
        //                     "profile-view",
        //                     "/profile",
        //                 ),
        //                 setSubMenu(
        //                     "Lock Screen",
        //                     null,
        //                     "lockscreen-view",
        //                     "/lock-screen",
        //                 ),



        //             ]

        //         ],

        //     ],
        //     [
        //         "heading" => "Session",
        //     ],
        //     [
        //         "single_link" => setSingleLink("Log out", "log-out", "services-view", "/logout"),
        //     ],


        ];
    }
}
