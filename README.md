# testweb
g:ITS member login system basic working;
h:ITS member login system user status and role update and reset password function added.
i:ITS changed roles from a to z in member table, more robust modularized file structure and design pattern.
j:ITS add basic business module user has a role as c can create business, and added basic funding module, a user can fund they own business or other business. modified updateUser method in UserController.php so that only user with a role as r can update user info.
k:ITS add basic records module.now there are user,business,funding and records total of 4 modules.
l: ITS add basic records module improments, such that only sufficient shareholders and approve candidates can insert records.
