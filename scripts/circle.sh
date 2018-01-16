#!/bin/bash

_project=$1
_branch=$2
_circle_token=$3

trigger_build_url=https://circleci.com/api/v1.1/project/github/${_project}/tree/${_branch}?circle-token=${_circle_token}

curl \
--header "Accept: application/json" \
--header "Content-Type: application/json" \
--request POST ${trigger_build_url}
