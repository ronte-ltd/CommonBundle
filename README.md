# The Common Bundle
This bundle contains some methods for help
## Installation
### Composer
```sh
composer require ronte-ltd/common-bundle
```
### AppKernel.php
```php
new RonteLtd\ElasticBundle\RonteLtdElasticBundle()
```
## Usage
### Entity
```php
<?php

namespace AppBundle\Entity;

use RonteLtd\CommonBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 * @ORM\Table(name="some_entity")
 */
class Entity extends AbstractEntity
{
}
```
### Repository
```php
<?php

namespace AppBundle\Repository;

use RonteLtd\CommonBundle\Entity\AbstractEntityRepository;

class DefaultRepository extends AbstractEntityRepository
{
}
```
### Service
```php
<?php

namespace AppBundle\Service;

use RonteLtd\CommonBundle\Entity\AbstractEntityService;

class EntityService extends AbstractEntityService
{
}
```

For explanation we can use this code to define custom service
```Yaml
services:
    ## Repositories
    app.entity_repository:
        class: AppBundle\Repository\DefaultRepository
        factory: ["@doctrine.orm.entity_manager", getRepository]
        arguments:
            - AppBundle\Entity\Entity

    ## Services
    app.entity_service:
        class: AppBundle\Service\EntityService
        arguments: ["@validator", "@event_dispatcher"]
        calls:
            - [setRepository, ['@app.entity_repository']]
```
### Controller
For quick example
```php
// We are recieving the service with repository
$service = $this->get('app.entity_service');
$entity = new Entity();

// validate
$result = $service->validate($entity)

// save|remove:
$service->save($entity);
$service->remove($entity);

// paginate
$service->paginate($query)
```