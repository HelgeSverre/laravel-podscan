<?php

namespace HelgeSverre\Podscan\Resource;

use HelgeSverre\Podscan\Requests\Alerts\AlertsCreate;
use HelgeSverre\Podscan\Requests\Alerts\AlertsDelete;
use HelgeSverre\Podscan\Requests\Alerts\AlertsIndex;
use HelgeSverre\Podscan\Requests\Alerts\AlertsMentionsIndex;
use HelgeSverre\Podscan\Requests\Alerts\AlertsMentionsShow;
use HelgeSverre\Podscan\Requests\Alerts\AlertsShow;
use HelgeSverre\Podscan\Requests\Alerts\AlertsUpdate;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Alerts extends BaseResource
{
    /**
     * @param  string  $team  The ID of the team as a string
     */
    public function list(string $team): Response
    {
        return $this->connector->send(new AlertsIndex($team));
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alertName  Name of the alert, mostly for reference in the UI and notification emails
     * @param  array  $promptFilters  A list of strings to scan for, with wildcard (`word*`), negation (`word NOT unwanted_word`), and phrase (`"word word"`) support
     *                                Has to be between 1 and 10 items.
     * @param  bool  $alertEnabled  Whether the alert should run or be paused. `true` or `false`.
     * @param  string  $notificationEmail  An email address to send a notification to when a new mention is found. Defaults to your account's email or the team's email if set.
     * @param  bool  $notificationSummaryEnabled  Whether to send a summary of the alert's mentions instead of one email per mention. `true` or `false`.
     * @param  mixed  $notificationSummaryFrequency  How often to send a summary of the alert's mentions. `daily`, `weekly`, or `monthly`.
     * @param  bool  $webhookEnabled  Whether to send a POST request to a URL when a new mention is found. `true` or `false`.
     * @param  mixed  $webhookUrl  A URL to send a POST request to when a new mention is found. The request will contain a JSON object with the mention's details.
     * @param  bool  $promptQuestionEnabled  Whether to ask an AI-answered question of teh transcript when a new mention is found. `true` or `false`. Defaults to `false`.
     * @param  mixed  $promptQuestion  The Yes/No question to ask the AI when a new mention is found. Only used if `prompt_question_enabled` is `true`.
     * @param  mixed  $restrictToCategoryIds  A comma-separated list of category IDs to restrict the alert to. If not set, the alert will scan all categories.
     * @param  mixed  $restrictToPodcastIds  A comma-separated list of podcast IDs to restrict the alert to. If not set, the alert will scan all podcasts.
     */
    public function create(
        string $team,
        string $alertName,
        array $promptFilters,
        bool $alertEnabled = false,
        ?string $notificationEmail = null,
        ?bool $notificationSummaryEnabled = null,
        ?string $notificationSummaryFrequency = null,
        ?string $webhookUrl = null,
        ?string $promptQuestion = null,
        ?array $restrictToCategoryIds = null,
        ?array $restrictToPodcastIds = null,
    ): Response {
        return $this->connector->send(new AlertsCreate(
            team: $team,
            alertName: $alertName,
            promptFilters: $promptFilters,
            alertEnabled: $alertEnabled,
            notificationEmail: $notificationEmail,
            notificationSummaryEnabled: $notificationSummaryEnabled,
            notificationSummaryFrequency: $notificationSummaryFrequency,
            webhookUrl: $webhookUrl,
            promptQuestion: $promptQuestion,
            restrictToCategoryIds: $restrictToCategoryIds,
            restrictToPodcastIds: $restrictToPodcastIds
        ));
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     */
    public function get(string $team, string $alert): Response
    {
        return $this->connector->send(new AlertsShow($team, $alert));
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     * @param  string  $alertName  Name of the alert, mostly for reference in the UI and notification emails
     * @param  array  $promptFilters  A list of strings to scan for, with wildcard (`word*`), negation (`word NOT unwanted_word`), and phrase (`"word word"`) support
     *                                Has to be between 1 and 10 items.
     * @param  bool  $alertEnabled  Whether the alert should run or be paused. `true` or `false`.
     * @param  string  $notificationEmail  An email address to send a notification to when a new mention is found. Defaults to your account's email or the team's email if set.
     * @param  bool  $notificationSummaryEnabled  Whether to send a summary of the alert's mentions instead of one email per mention. `true` or `false`.
     * @param  mixed  $notificationSummaryFrequency  How often to send a summary of the alert's mentions. `daily`, `weekly`, or `monthly`.
     * @param  bool  $webhookEnabled  Whether to send a POST request to a URL when a new mention is found. `true` or `false`.
     * @param  mixed  $webhookUrl  A URL to send a POST request to when a new mention is found. The request will contain a JSON object with the mention's details.
     * @param  bool  $promptQuestionEnabled  Whether to ask an AI-answered question of teh transcript when a new mention is found. `true` or `false`. Defaults to `false`.
     * @param  mixed  $promptQuestion  The Yes/No question to ask the AI when a new mention is found. Only used if `prompt_question_enabled` is `true`.
     * @param  mixed  $restrictToCategoryIds  A comma-separated list of category IDs to restrict the alert to. If not set, the alert will scan all categories.
     * @param  mixed  $restrictToPodcastIds  A comma-separated list of podcast IDs to restrict the alert to. If not set, the alert will scan all podcasts.
     */
    public function update(
        string $team,
        string $alert,
        string $alertName,
        array $promptFilters,
        bool $alertEnabled,
        string $notificationEmail,
        bool $notificationSummaryEnabled,
        mixed $notificationSummaryFrequency,
        bool $webhookEnabled,
        mixed $webhookUrl,
        bool $promptQuestionEnabled,
        mixed $promptQuestion,
        mixed $restrictToCategoryIds,
        mixed $restrictToPodcastIds,
    ): Response {
        return $this->connector->send(new AlertsUpdate(
            team: $team,
            alert: $alert,
            alertName: $alertName,
            promptFilters: $promptFilters,
            alertEnabled: $alertEnabled,
            notificationEmail: $notificationEmail,
            notificationSummaryEnabled: $notificationSummaryEnabled,
            notificationSummaryFrequency: $notificationSummaryFrequency,
            webhookEnabled: $webhookEnabled,
            webhookUrl: $webhookUrl,
            promptQuestionEnabled: $promptQuestionEnabled,
            promptQuestion: $promptQuestion,
            restrictToCategoryIds: $restrictToCategoryIds,
            restrictToPodcastIds: $restrictToPodcastIds
        ));
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     */
    public function delete(string $team, string $alert): Response
    {
        return $this->connector->send(new AlertsDelete($team, $alert));
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     */
    public function mentions(string $team, string $alert): Response
    {
        return $this->connector->send(new AlertsMentionsIndex($team, $alert));
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     * @param  string  $mention  The ID of the mention as a string
     */
    public function mention(string $team, string $alert, string $mention): Response
    {
        return $this->connector->send(new AlertsMentionsShow($team, $alert, $mention));
    }
}
