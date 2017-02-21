<?php

namespace JiraApi\Clients;

use JiraApi\Clients\AbstractClient;

class ProjectClient extends AbstractClient
{
    /**
     * Returns all projects visible for the user
     *
     * @link  https://docs.atlassian.com/jira/REST/latest/#d2e2304
     *
     * @return GuzzleHttp\Message\Response
     */
    public function getAll()
    {
        return $this->getRequest('project');
    }

    /**
     * Returns project by its id or key
     *
     * @link  https://docs.atlassian.com/jira/REST/latest/#d2e2322
     *
     * @param  integer|string $idOrKey
     *
     * @return GuzzleHttp\Message\Response
     */
    public function get($idOrKey)
    {
        return $this->getRequest(sprintf('project/%s', $idOrKey));
    }

    /**
     * Returns project versions by its id or key
     *
     * @link  https://docs.atlassian.com/jira/REST/latest/#d2e2349
     *
     * @param  integer|string $idOrKey
     *
     * @return GuzzleHttp\Message\Response
     */
    public function getVersions($idOrKey)
    {
        return $this->getRequest(sprintf('project/%s/versions', $idOrKey));
    }

    /**
     * Returns project issue types with valid status values by its id or key
     *
     * @link  https://docs.atlassian.com/jira/REST/latest/#d2e2536
     *
     * @param  integer|string $idOrKey
     *
     * @return GuzzleHttp\Message\Response
     */
    public function getStatuses($idOrKey)
    {
        return $this->getRequest(sprintf('project/%s/statuses', $idOrKey));
    }

}
