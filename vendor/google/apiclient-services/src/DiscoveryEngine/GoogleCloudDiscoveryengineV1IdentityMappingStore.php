<?php
/*
 * Copyright 2014 Google Inc.
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

namespace Google\Service\DiscoveryEngine;

class GoogleCloudDiscoveryengineV1IdentityMappingStore extends \Google\Model
{
  protected $cmekConfigType = GoogleCloudDiscoveryengineV1CmekConfig::class;
  protected $cmekConfigDataType = '';
  /**
   * @var string
   */
  public $kmsKeyName;
  /**
   * @var string
   */
  public $name;

  /**
   * @param GoogleCloudDiscoveryengineV1CmekConfig
   */
  public function setCmekConfig(GoogleCloudDiscoveryengineV1CmekConfig $cmekConfig)
  {
    $this->cmekConfig = $cmekConfig;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1CmekConfig
   */
  public function getCmekConfig()
  {
    return $this->cmekConfig;
  }
  /**
   * @param string
   */
  public function setKmsKeyName($kmsKeyName)
  {
    $this->kmsKeyName = $kmsKeyName;
  }
  /**
   * @return string
   */
  public function getKmsKeyName()
  {
    return $this->kmsKeyName;
  }
  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1IdentityMappingStore::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1IdentityMappingStore');
