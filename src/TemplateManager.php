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


    private function computeText($text, array $data)
    {
        $user = $this->getUserFromArray($data);
        $quote = $this->getQuoteFromArray($data);

        if ($quote) {
            $_quoteFromRepository = QuoteRepository::getInstance()->getById($quote->getId());
            $usefulObject = SiteRepository::getInstance()->getById($quote->getSiteId());
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->getDestinationId());

            if(strpos($text, '[quote:destination_link]') !== false){
                $destination = DestinationRepository::getInstance()->getById($quote->getDestinationId());
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary     = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false || $containsSummary !== false) {
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        RendererHtml::render($_quoteFromRepository->getId()),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        RendererString::render($_quoteFromRepository->getId()),
                        $text
                    );
                }
            }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destinationOfQuote->getCountryName(),$text);
        }

        if (isset($destination))
            $text = str_replace('[quote:destination_link]', $usefulObject->getUrl() . '/' . $destination->getCountryName() . '/quote/' . $_quoteFromRepository->getId(), $text);
        else
            $text = str_replace('[quote:destination_link]', '', $text);


        if($user) {
            (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]'       , $user->getFirstname(), $text);
        }

        return $text;
    }
}
