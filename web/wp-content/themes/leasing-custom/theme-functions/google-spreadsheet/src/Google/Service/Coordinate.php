<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

/**
 * Service definition for Coordinate (v1).
 *
 * <p>
 * Lets you view and manage jobs in a Coordinate team.</p>
 *
 * <p>
 * For more information about this service, see the API
 * <a href="https://developers.google.com/coordinate/" target="_blank">Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class Google_Service_Coordinate extends Google_Service
{
  /** View and manage your Google Maps Coordinate jobs. */
  const COORDINATE =
      "https://www.googleapis.com/auth/coordinate";
  /** View your Google Coordinate jobs. */
  const COORDINATE_READONLY =
      "https://www.googleapis.com/auth/coordinate.readonly";

  public $customFieldDef;
  public $jobs;
  public $location;
  public $schedule;
  public $team;
  public $worker;
  

  /**
   * Constructs the internal representation of the Coordinate service.
   *
   * @param Google_Client $client
   */
  public function __construct(Google_Client $client)
  {
    parent::__construct($client);
    $this->servicePath = 'coordinate/v1/';
    $this->version = 'v1';
    $this->serviceName = 'coordinate';

    $this->customFieldDef = new Google_Service_Coordinate_CustomFieldDef_Resource(
        $this,
        $this->serviceName,
        'customFieldDef',
        array(
          'methods' => array(
            'list' => array(
              'path' => 'teams/{teamId}/custom_fields',
              'httpMethod' => 'GET',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),
          )
        )
    );
    $this->jobs = new Google_Service_Coordinate_Jobs_Resource(
        $this,
        $this->serviceName,
        'jobs',
        array(
          'methods' => array(
            'get' => array(
              'path' => 'teams/{teamId}/jobs/{jobId}',
              'httpMethod' => 'GET',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'jobId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),'insert' => array(
              'path' => 'teams/{teamId}/jobs',
              'httpMethod' => 'POST',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'address' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'required' => true,
                ),
                'lat' => array(
                  'location' => 'query',
                  'type' => 'number',
                  'required' => true,
                ),
                'lng' => array(
                  'location' => 'query',
                  'type' => 'number',
                  'required' => true,
                ),
                'title' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'required' => true,
                ),
                'customerName' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'note' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'assignee' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'customerPhoneNumber' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'customField' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'repeated' => true,
                ),
              ),
            ),'list' => array(
              'path' => 'teams/{teamId}/jobs',
              'httpMethod' => 'GET',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'minModifiedTimestampMs' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'maxResults' => array(
                  'location' => 'query',
                  'type' => 'integer',
                ),
                'pageToken' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
              ),
            ),'patch' => array(
              'path' => 'teams/{teamId}/jobs/{jobId}',
              'httpMethod' => 'PATCH',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'jobId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'customerName' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'title' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'note' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'assignee' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'customerPhoneNumber' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'address' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'lat' => array(
                  'location' => 'query',
                  'type' => 'number',
                ),
                'progress' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'lng' => array(
                  'location' => 'query',
                  'type' => 'number',
                ),
                'customField' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'repeated' => true,
                ),
              ),
            ),'update' => array(
              'path' => 'teams/{teamId}/jobs/{jobId}',
              'httpMethod' => 'PUT',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'jobId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'customerName' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'title' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'note' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'assignee' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'customerPhoneNumber' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'address' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'lat' => array(
                  'location' => 'query',
                  'type' => 'number',
                ),
                'progress' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'lng' => array(
                  'location' => 'query',
                  'type' => 'number',
                ),
                'customField' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'repeated' => true,
                ),
              ),
            ),
          )
        )
    );
    $this->location = new Google_Service_Coordinate_Location_Resource(
        $this,
        $this->serviceName,
        'location',
        array(
          'methods' => array(
            'list' => array(
              'path' => 'teams/{teamId}/workers/{workerEmail}/locations',
              'httpMethod' => 'GET',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'workerEmail' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'startTimestampMs' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'required' => true,
                ),
                'pageToken' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'maxResults' => array(
                  'location' => 'query',
                  'type' => 'integer',
                ),
              ),
            ),
          )
        )
    );
    $this->schedule = new Google_Service_Coordinate_Schedule_Resource(
        $this,
        $this->serviceName,
        'schedule',
        array(
          'methods' => array(
            'get' => array(
              'path' => 'teams/{teamId}/jobs/{jobId}/schedule',
              'httpMethod' => 'GET',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'jobId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),'patch' => array(
              'path' => 'teams/{teamId}/jobs/{jobId}/schedule',
              'httpMethod' => 'PATCH',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'jobId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'allDay' => array(
                  'location' => 'query',
                  'type' => 'boolean',
                ),
                'startTime' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'duration' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'endTime' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
              ),
            ),'update' => array(
              'path' => 'teams/{teamId}/jobs/{jobId}/schedule',
              'httpMethod' => 'PUT',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'jobId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'allDay' => array(
                  'location' => 'query',
                  'type' => 'boolean',
                ),
                'startTime' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'duration' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
                'endTime' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
              ),
            ),
          )
        )
    );
    $this->team = new Google_Service_Coordinate_Team_Resource(
        $this,
        $this->serviceName,
        'team',
        array(
          'methods' => array(
            'list' => array(
              'path' => 'teams',
              'httpMethod' => 'GET',
              'parameters' => array(
                'admin' => array(
                  'location' => 'query',
                  'type' => 'boolean',
                ),
                'worker' => array(
                  'location' => 'query',
                  'type' => 'boolean',
                ),
                'dispatcher' => array(
                  'location' => 'query',
                  'type' => 'boolean',
                ),
              ),
            ),
          )
        )
    );
    $this->worker = new Google_Service_Coordinate_Worker_Resource(
        $this,
        $this->serviceName,
        'worker',
        array(
          'methods' => array(
            'list' => array(
              'path' => 'teams/{teamId}/workers',
              'httpMethod' => 'GET',
              'parameters' => array(
                'teamId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),
          )
        )
    );
  }
}


/**
 * The "customFieldDef" collection of methods.
 * Typical usage is:
 *  <code>
 *   $coordinateService = new Google_Service_Coordinate(...);
 *   $customFieldDef = $coordinateService->customFieldDef;
 *  </code>
 */
class Google_Service_Coordinate_CustomFieldDef_Resource extends Google_Service_Resource
{

  /**
   * Retrieves a list of custom field definitions for a team.
   * (customFieldDef.listCustomFieldDef)
   *
   * @param string $teamId Team ID
   * @param array $optParams Optional parameters.
   * @return Google_Service_Coordinate_CustomFieldDefListResponse
   */
  public function listCustomFieldDef($teamId, $optParams = array())
  {
    $params = array('teamId' => $teamId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Coordinate_CustomFieldDefListResponse");
  }
}

/**
 * The "jobs" collection of methods.
 * Typical usage is:
 *  <code>
 *   $coordinateService = new Google_Service_Coordinate(...);
 *   $jobs = $coordinateService->jobs;
 *  </code>
 */
class Google_Service_Coordinate_Jobs_Resource extends Google_Service_Resource
{

  /**
   * Retrieves a job, including all the changes made to the job. (jobs.get)
   *
   * @param string $teamId Team ID
   * @param string $jobId Job number
   * @param array $optParams Optional parameters.
   * @return Google_Service_Coordinate_Job
   */
  public function get($teamId, $jobId, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'jobId' => $jobId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_Coordinate_Job");
  }

  /**
   * Inserts a new job. Only the state field of the job should be set.
   * (jobs.insert)
   *
   * @param string $teamId Team ID
   * @param string $address Job address as newline (Unix) separated string
   * @param double $lat The latitude coordinate of this job's location.
   * @param double $lng The longitude coordinate of this job's location.
   * @param string $title Job title
   * @param Google_Job $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string customerName Customer name
   * @opt_param string note Job note as newline (Unix) separated string
   * @opt_param string assignee Assignee email address, or empty string to
   * unassign.
   * @opt_param string customerPhoneNumber Customer phone number
   * @opt_param string customField Sets the value of custom fields. To set a
   * custom field, pass the field id (from /team/teamId/custom_fields), a URL
   * escaped '=' character, and the desired value as a parameter. For example,
   * customField=12%3DAlice. Repeat the parameter for each custom field. Note that
   * '=' cannot appear in the parameter value. Specifying an invalid, or inactive
   * enum field will result in an error 500.
   * @return Google_Service_Coordinate_Job
   */
  public function insert($teamId, $address, $lat, $lng, $title, Google_Service_Coordinate_Job $postBody, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'address' => $address, 'lat' => $lat, 'lng' => $lng, 'title' => $title, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('insert', array($params), "Google_Service_Coordinate_Job");
  }

  /**
   * Retrieves jobs created or modified since the given timestamp. (jobs.listJobs)
   *
   * @param string $teamId Team ID
   * @param array $optParams Optional parameters.
   *
   * @opt_param string minModifiedTimestampMs Minimum time a job was modified in
   * milliseconds since epoch.
   * @opt_param string maxResults Maximum number of results to return in one page.
   * @opt_param string pageToken Continuation token
   * @return Google_Service_Coordinate_JobListResponse
   */
  public function listJobs($teamId, $optParams = array())
  {
    $params = array('teamId' => $teamId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Coordinate_JobListResponse");
  }

  /**
   * Updates a job. Fields that are set in the job state will be updated. This
   * method supports patch semantics. (jobs.patch)
   *
   * @param string $teamId Team ID
   * @param string $jobId Job number
   * @param Google_Job $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string customerName Customer name
   * @opt_param string title Job title
   * @opt_param string note Job note as newline (Unix) separated string
   * @opt_param string assignee Assignee email address, or empty string to
   * unassign.
   * @opt_param string customerPhoneNumber Customer phone number
   * @opt_param string address Job address as newline (Unix) separated string
   * @opt_param double lat The latitude coordinate of this job's location.
   * @opt_param string progress Job progress
   * @opt_param double lng The longitude coordinate of this job's location.
   * @opt_param string customField Sets the value of custom fields. To set a
   * custom field, pass the field id (from /team/teamId/custom_fields), a URL
   * escaped '=' character, and the desired value as a parameter. For example,
   * customField=12%3DAlice. Repeat the parameter for each custom field. Note that
   * '=' cannot appear in the parameter value. Specifying an invalid, or inactive
   * enum field will result in an error 500.
   * @return Google_Service_Coordinate_Job
   */
  public function patch($teamId, $jobId, Google_Service_Coordinate_Job $postBody, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'jobId' => $jobId, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('patch', array($params), "Google_Service_Coordinate_Job");
  }

  /**
   * Updates a job. Fields that are set in the job state will be updated.
   * (jobs.update)
   *
   * @param string $teamId Team ID
   * @param string $jobId Job number
   * @param Google_Job $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string customerName Customer name
   * @opt_param string title Job title
   * @opt_param string note Job note as newline (Unix) separated string
   * @opt_param string assignee Assignee email address, or empty string to
   * unassign.
   * @opt_param string customerPhoneNumber Customer phone number
   * @opt_param string address Job address as newline (Unix) separated string
   * @opt_param double lat The latitude coordinate of this job's location.
   * @opt_param string progress Job progress
   * @opt_param double lng The longitude coordinate of this job's location.
   * @opt_param string customField Sets the value of custom fields. To set a
   * custom field, pass the field id (from /team/teamId/custom_fields), a URL
   * escaped '=' character, and the desired value as a parameter. For example,
   * customField=12%3DAlice. Repeat the parameter for each custom field. Note that
   * '=' cannot appear in the parameter value. Specifying an invalid, or inactive
   * enum field will result in an error 500.
   * @return Google_Service_Coordinate_Job
   */
  public function update($teamId, $jobId, Google_Service_Coordinate_Job $postBody, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'jobId' => $jobId, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('update', array($params), "Google_Service_Coordinate_Job");
  }
}

/**
 * The "location" collection of methods.
 * Typical usage is:
 *  <code>
 *   $coordinateService = new Google_Service_Coordinate(...);
 *   $location = $coordinateService->location;
 *  </code>
 */
class Google_Service_Coordinate_Location_Resource extends Google_Service_Resource
{

  /**
   * Retrieves a list of locations for a worker. (location.listLocation)
   *
   * @param string $teamId Team ID
   * @param string $workerEmail Worker email address.
   * @param string $startTimestampMs Start timestamp in milliseconds since the
   * epoch.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken Continuation token
   * @opt_param string maxResults Maximum number of results to return in one page.
   * @return Google_Service_Coordinate_LocationListResponse
   */
  public function listLocation($teamId, $workerEmail, $startTimestampMs, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'workerEmail' => $workerEmail, 'startTimestampMs' => $startTimestampMs);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Coordinate_LocationListResponse");
  }
}

/**
 * The "schedule" collection of methods.
 * Typical usage is:
 *  <code>
 *   $coordinateService = new Google_Service_Coordinate(...);
 *   $schedule = $coordinateService->schedule;
 *  </code>
 */
class Google_Service_Coordinate_Schedule_Resource extends Google_Service_Resource
{

  /**
   * Retrieves the schedule for a job. (schedule.get)
   *
   * @param string $teamId Team ID
   * @param string $jobId Job number
   * @param array $optParams Optional parameters.
   * @return Google_Service_Coordinate_Schedule
   */
  public function get($teamId, $jobId, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'jobId' => $jobId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_Coordinate_Schedule");
  }

  /**
   * Replaces the schedule of a job with the provided schedule. This method
   * supports patch semantics. (schedule.patch)
   *
   * @param string $teamId Team ID
   * @param string $jobId Job number
   * @param Google_Schedule $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param bool allDay Whether the job is scheduled for the whole day. Time
   * of day in start/end times is ignored if this is true.
   * @opt_param string startTime Scheduled start time in milliseconds since epoch.
   * @opt_param string duration Job duration in milliseconds.
   * @opt_param string endTime Scheduled end time in milliseconds since epoch.
   * @return Google_Service_Coordinate_Schedule
   */
  public function patch($teamId, $jobId, Google_Service_Coordinate_Schedule $postBody, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'jobId' => $jobId, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('patch', array($params), "Google_Service_Coordinate_Schedule");
  }

  /**
   * Replaces the schedule of a job with the provided schedule. (schedule.update)
   *
   * @param string $teamId Team ID
   * @param string $jobId Job number
   * @param Google_Schedule $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param bool allDay Whether the job is scheduled for the whole day. Time
   * of day in start/end times is ignored if this is true.
   * @opt_param string startTime Scheduled start time in milliseconds since epoch.
   * @opt_param string duration Job duration in milliseconds.
   * @opt_param string endTime Scheduled end time in milliseconds since epoch.
   * @return Google_Service_Coordinate_Schedule
   */
  public function update($teamId, $jobId, Google_Service_Coordinate_Schedule $postBody, $optParams = array())
  {
    $params = array('teamId' => $teamId, 'jobId' => $jobId, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('update', array($params), "Google_Service_Coordinate_Schedule");
  }
}

/**
 * The "team" collection of methods.
 * Typical usage is:
 *  <code>
 *   $coordinateService = new Google_Service_Coordinate(...);
 *   $team = $coordinateService->team;
 *  </code>
 */
class Google_Service_Coordinate_Team_Resource extends Google_Service_Resource
{

  /**
   * Retrieves a list of teams for a user. (team.listTeam)
   *
   * @param array $optParams Optional parameters.
   *
   * @opt_param bool admin Whether to include teams for which the user has the
   * Admin role.
   * @opt_param bool worker Whether to include teams for which the user has the
   * Worker role.
   * @opt_param bool dispatcher Whether to include teams for which the user has
   * the Dispatcher role.
   * @return Google_Service_Coordinate_TeamListResponse
   */
  public function listTeam($optParams = array())
  {
    $params = array();
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Coordinate_TeamListResponse");
  }
}

/**
 * The "worker" collection of methods.
 * Typical usage is:
 *  <code>
 *   $coordinateService = new Google_Service_Coordinate(...);
 *   $worker = $coordinateService->worker;
 *  </code>
 */
class Google_Service_Coordinate_Worker_Resource extends Google_Service_Resource
{

  /**
   * Retrieves a list of workers in a team. (worker.listWorker)
   *
   * @param string $teamId Team ID
   * @param array $optParams Optional parameters.
   * @return Google_Service_Coordinate_WorkerListResponse
   */
  public function listWorker($teamId, $optParams = array())
  {
    $params = array('teamId' => $teamId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Coordinate_WorkerListResponse");
  }
}




class Google_Service_Coordinate_CustomField extends Google_Model
{
  protected $internal_gapi_mappings = array(
  );
  public $customFieldId;
  public $kind;
  public $value;


  public function setCustomFieldId($customFieldId)
  {
    $this->customFieldId = $customFieldId;
  }
  public function getCustomFieldId()
  {
    return $this->customFieldId;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setValue($value)
  {
    $this->value = $value;
  }
  public function getValue()
  {
    return $this->value;
  }
}

class Google_Service_Coordinate_CustomFieldDef extends Google_Collection
{
  protected $collection_key = 'enumitems';
  protected $internal_gapi_mappings = array(
  );
  public $enabled;
  protected $enumitemsType = 'Google_Service_Coordinate_EnumItemDef';
  protected $enumitemsDataType = 'array';
  public $id;
  public $kind;
  public $name;
  public $requiredForCheckout;
  public $type;


  public function setEnabled($enabled)
  {
    $this->enabled = $enabled;
  }
  public function getEnabled()
  {
    return $this->enabled;
  }
  public function setEnumitems($enumitems)
  {
    $this->enumitems = $enumitems;
  }
  public function getEnumitems()
  {
    return $this->enumitems;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    ret