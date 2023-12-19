# Identity Provider + Tenancy

Identity Providers with Tenancy is a concept that combines identity management and tenancy management. An identity provider is a service that manages user identities and authentication, while tenancy refers to the division of resources and access rights within a system. When these two concepts are combined, it allows for efficient management of user identities and their corresponding access privileges within different tenants or organisational units. This integration ensures secure and controlled access to resources based on user roles and permissions, enhancing overall system security and usability.

## Identity (SSO)

This project will be built using using Laravel, and for simplicity we will off the bat use the [Laravel Breeze starter kit](https://laravel.com/docs/10.x/starter-kits#breeze-and-blade) so we can have Authentication and Authorisation out of the way. 

Breeze’s blade templates use [Tailwind CSS](https://tailwindcss.com/) for UI styling, but to extend this, we will also add [DaisyUI](https://daisyui.com/) which is a more structured way to use Tailwind for your UI elements.

Most Identity providers use OAuth so we will use [Laravel passport](https://laravel.com/docs/10.x/passport#main-content) to leverage these capabilities.