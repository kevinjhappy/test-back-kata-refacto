<?php

class TemplateManager implements TemplateManagerInterface
{
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $subject = $this->computeText($tpl->getSubject(), $data);
        $content = $this->computeText($tpl->getContent(), $data);

        return new Template($tpl->getId(), $subject, $content);
    }

    /**
     * @param array $data
     * @return Quote|null
     */
    public function getQuoteFromArray(array $data)
    {
        if (isset($data['quote']) && $data['quote'] instanceof Quote) {
            return $data['quote'];
        }

        return null;
    }


    public function getDestinationUrl($websiteUrl, $countryName, $quoteId)
    {
        return $websiteUrl . '/' . $countryName . '/quote/' . $quoteId;
    }

    /**
     * @param array $data
     * @return User
     */
    public function getUserFromArray(array $data)
    {
        if (isset($data['user']) && ($data['user'] instanceof User)) {
            return $data['user'];
        }

        return ApplicationContext::getInstance()->getCurrentUser();
    }

    private function setDestinationUrlToTemplateData(TemplateData $templateData, Site $site, $countryName, $quoteId)
    {
        if ($templateData->check(TemplateData::QUOTE_DESTINATION_LINK) && isset($site)) {
            $url = $this->getDestinationUrl($site->getUrl(), $countryName, $quoteId);
            $templateData->replaceAttributeNameToValue(TemplateData::QUOTE_DESTINATION_LINK, $url);
            return;
        }

        $templateData->replaceAttributeNameToValue(TemplateData::QUOTE_DESTINATION_LINK, '');
    }

    private function computeText($text, array $data)
    {
        $templateData = new TemplateData($text);
        $user = $this->getUserFromArray($data);

        if ($quote = $this->getQuoteFromArray($data)) {
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->getDestinationId());
            $site = SiteRepository::getInstance()->getById($quote->getSiteId());

            $this->setDestinationUrlToTemplateData($templateData, $site, $destinationOfQuote->getCountryName(), $quote->getId());

            $templateData->replaceAttributeNameToValue(TemplateData::QUOTE_DESTINATION_NAME, $destinationOfQuote->getCountryName());
            $templateData->replaceAttributeNameToValue(TemplateData::QUOTE_SUMMARY_HTML, RendererHtml::render($quote->getId()));
            $templateData->replaceAttributeNameToValue(TemplateData::QUOTE_SUMMARY, RendererString::render($quote->getId()));
        }

        $templateData->replaceAttributeNameToValue(TemplateData::USER_FIRST_NAME, $user->getFirstname());

        return $templateData->getTemplateData();
    }
}
