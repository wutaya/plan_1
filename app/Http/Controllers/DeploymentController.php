<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeploymentController extends Controller
{
    public function deploy(Request $request)
    {
        $commands = ['cd /var/www/html/plan_1', 'git pull'];
        $signature = $request->header('X-Hub-Signature');
        $payload = file_get_contents('php://input');
        if ($this->isFromGithub($payload, $signature)) {
            foreach ($commands as $command) {
                shell_exec($command);
            }
            http_response_code(200);
        } else {
            abort(403);
        }
    }

    public function test()
    {
        $payload = "{
  \"ref\": \"refs/heads/master\",
  \"before\": \"4f537b6c08c2d61b2cca4b529f43a6feeda92ced\",
  \"after\": \"0751ee9c831ab6dfdd78ec153ce21d9255892fb3\",
  \"created\": false,
  \"deleted\": false,
  \"forced\": false,
  \"base_ref\": null,
  \"compare\": \"https://github.com/wutaya/plan_1/compare/4f537b6c08c2...0751ee9c831a\",
  \"commits\": [
    {
      \"id\": \"0751ee9c831ab6dfdd78ec153ce21d9255892fb3\",
      \"tree_id\": \"b5a704a2701c27ba5744515d6c66c186cdb7d4e7\",
      \"distinct\": true,
      \"message\": \"update\",
      \"timestamp\": \"2018-08-29T12:00:04+08:00\",
      \"url\": \"https://github.com/wutaya/plan_1/commit/0751ee9c831ab6dfdd78ec153ce21d9255892fb3\",
      \"author\": {
        \"name\": \"wutaya\",
        \"email\": \"wu1940@foxmail.com\",
        \"username\": \"wutaya\"
      },
      \"committer\": {
        \"name\": \"wutaya\",
        \"email\": \"wu1940@foxmail.com\",
        \"username\": \"wutaya\"
      },
      \"added\": [

      ],
      \"removed\": [

      ],
      \"modified\": [
        \"resources/views/welcome.blade.php\"
      ]
    }
  ],
  \"head_commit\": {
    \"id\": \"0751ee9c831ab6dfdd78ec153ce21d9255892fb3\",
    \"tree_id\": \"b5a704a2701c27ba5744515d6c66c186cdb7d4e7\",
    \"distinct\": true,
    \"message\": \"update\",
    \"timestamp\": \"2018-08-29T12:00:04+08:00\",
    \"url\": \"https://github.com/wutaya/plan_1/commit/0751ee9c831ab6dfdd78ec153ce21d9255892fb3\",
    \"author\": {
      \"name\": \"wutaya\",
      \"email\": \"wu1940@foxmail.com\",
      \"username\": \"wutaya\"
    },
    \"committer\": {
      \"name\": \"wutaya\",
      \"email\": \"wu1940@foxmail.com\",
      \"username\": \"wutaya\"
    },
    \"added\": [

    ],
    \"removed\": [

    ],
    \"modified\": [
      \"resources/views/welcome.blade.php\"
    ]
  },
  \"repository\": {
    \"id\": 146412634,
    \"node_id\": \"MDEwOlJlcG9zaXRvcnkxNDY0MTI2MzQ=\",
    \"name\": \"plan_1\",
    \"full_name\": \"wutaya/plan_1\",
    \"owner\": {
      \"name\": \"wutaya\",
      \"email\": \"wu1940@foxmail.com\",
      \"login\": \"wutaya\",
      \"id\": 15243445,
      \"node_id\": \"MDQ6VXNlcjE1MjQzNDQ1\",
      \"avatar_url\": \"https://avatars2.githubusercontent.com/u/15243445?v=4\",
      \"gravatar_id\": \"\",
      \"url\": \"https://api.github.com/users/wutaya\",
      \"html_url\": \"https://github.com/wutaya\",
      \"followers_url\": \"https://api.github.com/users/wutaya/followers\",
      \"following_url\": \"https://api.github.com/users/wutaya/following{/other_user}\",
      \"gists_url\": \"https://api.github.com/users/wutaya/gists{/gist_id}\",
      \"starred_url\": \"https://api.github.com/users/wutaya/starred{/owner}{/repo}\",
      \"subscriptions_url\": \"https://api.github.com/users/wutaya/subscriptions\",
      \"organizations_url\": \"https://api.github.com/users/wutaya/orgs\",
      \"repos_url\": \"https://api.github.com/users/wutaya/repos\",
      \"events_url\": \"https://api.github.com/users/wutaya/events{/privacy}\",
      \"received_events_url\": \"https://api.github.com/users/wutaya/received_events\",
      \"type\": \"User\",
      \"site_admin\": false
    },
    \"private\": false,
    \"html_url\": \"https://github.com/wutaya/plan_1\",
    \"description\": null,
    \"fork\": false,
    \"url\": \"https://github.com/wutaya/plan_1\",
    \"forks_url\": \"https://api.github.com/repos/wutaya/plan_1/forks\",
    \"keys_url\": \"https://api.github.com/repos/wutaya/plan_1/keys{/key_id}\",
    \"collaborators_url\": \"https://api.github.com/repos/wutaya/plan_1/collaborators{/collaborator}\",
    \"teams_url\": \"https://api.github.com/repos/wutaya/plan_1/teams\",
    \"hooks_url\": \"https://api.github.com/repos/wutaya/plan_1/hooks\",
    \"issue_events_url\": \"https://api.github.com/repos/wutaya/plan_1/issues/events{/number}\",
    \"events_url\": \"https://api.github.com/repos/wutaya/plan_1/events\",
    \"assignees_url\": \"https://api.github.com/repos/wutaya/plan_1/assignees{/user}\",
    \"branches_url\": \"https://api.github.com/repos/wutaya/plan_1/branches{/branch}\",
    \"tags_url\": \"https://api.github.com/repos/wutaya/plan_1/tags\",
    \"blobs_url\": \"https://api.github.com/repos/wutaya/plan_1/git/blobs{/sha}\",
    \"git_tags_url\": \"https://api.github.com/repos/wutaya/plan_1/git/tags{/sha}\",
    \"git_refs_url\": \"https://api.github.com/repos/wutaya/plan_1/git/refs{/sha}\",
    \"trees_url\": \"https://api.github.com/repos/wutaya/plan_1/git/trees{/sha}\",
    \"statuses_url\": \"https://api.github.com/repos/wutaya/plan_1/statuses/{sha}\",
    \"languages_url\": \"https://api.github.com/repos/wutaya/plan_1/languages\",
    \"stargazers_url\": \"https://api.github.com/repos/wutaya/plan_1/stargazers\",
    \"contributors_url\": \"https://api.github.com/repos/wutaya/plan_1/contributors\",
    \"subscribers_url\": \"https://api.github.com/repos/wutaya/plan_1/subscribers\",
    \"subscription_url\": \"https://api.github.com/repos/wutaya/plan_1/subscription\",
    \"commits_url\": \"https://api.github.com/repos/wutaya/plan_1/commits{/sha}\",
    \"git_commits_url\": \"https://api.github.com/repos/wutaya/plan_1/git/commits{/sha}\",
    \"comments_url\": \"https://api.github.com/repos/wutaya/plan_1/comments{/number}\",
    \"issue_comment_url\": \"https://api.github.com/repos/wutaya/plan_1/issues/comments{/number}\",
    \"contents_url\": \"https://api.github.com/repos/wutaya/plan_1/contents/{+path}\",
    \"compare_url\": \"https://api.github.com/repos/wutaya/plan_1/compare/{base}...{head}\",
    \"merges_url\": \"https://api.github.com/repos/wutaya/plan_1/merges\",
    \"archive_url\": \"https://api.github.com/repos/wutaya/plan_1/{archive_format}{/ref}\",
    \"downloads_url\": \"https://api.github.com/repos/wutaya/plan_1/downloads\",
    \"issues_url\": \"https://api.github.com/repos/wutaya/plan_1/issues{/number}\",
    \"pulls_url\": \"https://api.github.com/repos/wutaya/plan_1/pulls{/number}\",
    \"milestones_url\": \"https://api.github.com/repos/wutaya/plan_1/milestones{/number}\",
    \"notifications_url\": \"https://api.github.com/repos/wutaya/plan_1/notifications{?since,all,participating}\",
    \"labels_url\": \"https://api.github.com/repos/wutaya/plan_1/labels{/name}\",
    \"releases_url\": \"https://api.github.com/repos/wutaya/plan_1/releases{/id}\",
    \"deployments_url\": \"https://api.github.com/repos/wutaya/plan_1/deployments\",
    \"created_at\": 1535443165,
    \"updated_at\": \"2018-08-29T03:46:20Z\",
    \"pushed_at\": 1535515225,
    \"git_url\": \"git://github.com/wutaya/plan_1.git\",
    \"ssh_url\": \"git@github.com:wutaya/plan_1.git\",
    \"clone_url\": \"https://github.com/wutaya/plan_1.git\",
    \"svn_url\": \"https://github.com/wutaya/plan_1\",
    \"homepage\": null,
    \"size\": 239,
    \"stargazers_count\": 0,
    \"watchers_count\": 0,
    \"language\": \"PHP\",
    \"has_issues\": true,
    \"has_projects\": true,
    \"has_downloads\": true,
    \"has_wiki\": true,
    \"has_pages\": false,
    \"forks_count\": 0,
    \"mirror_url\": null,
    \"archived\": false,
    \"open_issues_count\": 0,
    \"license\": null,
    \"forks\": 0,
    \"open_issues\": 0,
    \"watchers\": 0,
    \"default_branch\": \"master\",
    \"stargazers\": 0,
    \"master_branch\": \"master\"
  },
  \"pusher\": {
    \"name\": \"wutaya\",
    \"email\": \"wu1940@foxmail.com\"
  },
  \"sender\": {
    \"login\": \"wutaya\",
    \"id\": 15243445,
    \"node_id\": \"MDQ6VXNlcjE1MjQzNDQ1\",
    \"avatar_url\": \"https://avatars2.githubusercontent.com/u/15243445?v=4\",
    \"gravatar_id\": \"\",
    \"url\": \"https://api.github.com/users/wutaya\",
    \"html_url\": \"https://github.com/wutaya\",
    \"followers_url\": \"https://api.github.com/users/wutaya/followers\",
    \"following_url\": \"https://api.github.com/users/wutaya/following{/other_user}\",
    \"gists_url\": \"https://api.github.com/users/wutaya/gists{/gist_id}\",
    \"starred_url\": \"https://api.github.com/users/wutaya/starred{/owner}{/repo}\",
    \"subscriptions_url\": \"https://api.github.com/users/wutaya/subscriptions\",
    \"organizations_url\": \"https://api.github.com/users/wutaya/orgs\",
    \"repos_url\": \"https://api.github.com/users/wutaya/repos\",
    \"events_url\": \"https://api.github.com/users/wutaya/events{/privacy}\",
    \"received_events_url\": \"https://api.github.com/users/wutaya/received_events\",
    \"type\": \"User\",
    \"site_admin\": false
  }
}";
        $res = 'sha1=' . hash_hmac('sha1', $payload, env('GITHUB_DEPLOY_TOKEN', false));
        dump($res);
    }

    private function isFromGithub($payload, $signature)
    {
        return 'sha1=' . hash_hmac('sha1', $payload, env('GITHUB_DEPLOY_TOKEN', false)) === $signature;
    }
}