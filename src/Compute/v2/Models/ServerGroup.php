<?php

declare(strict_types=1);

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\Alias;
use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\OperatorResource;
use OpenStack\Common\Resource\Retrievable;
use OpenStack\Common\Transport\Utils;

/**
 * Represents a Compute v2 Server Group.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class ServerGroup extends OperatorResource implements Listable, Retrievable, Deletable, Creatable
{
    /** @var string */
    public $policy;

    /** @var string */
    public $name;

    /** @var string */
    public $members;

    /** @var string */
    public $rules;

    /** @var string */
    public $userId;


    /**
     * @var string
     */
    public $id;

    protected $aliases = [
        'user_id'     => 'userId',
    ];

    protected $resourceKey  = 'server_group';
    protected $resourcesKey = 'server_groups';

    protected function getAliases(): array
    {
        return parent::getAliases() + [
        ];
    }

    public function retrieve()
    {
        $response = $this->execute($this->api->getServerGroup(), $this->getAttrs(['id']));
        $this->populateFromResponse($response);
    }

    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postServerGroup(), $userOptions);

        return $this->populateFromResponse($response);
    }

    public function populateFromArray(array $array): self
    {
        return parent::populateFromArray(Utils::flattenJson($array, $this->resourceKey));
    }

    public function delete()
    {
        $this->execute($this->api->deleteServerGroup(), ['name' => (string) $this->name]);
    }
}
