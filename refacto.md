First of, I add interface to public function getTemplateComputed(Template $tpl, array $data) to not modify it

Then I addapt with interface and strategy pattern the method renderHtml and render Text from Quote to 2 class outside of the class Quote
With an interface to implement the function render

Then I applied defensive programming on all Entity to protect data and avoid public parameters (could use Value Object for some parameters likeUser First Name but this take too long).  as the project respect php => ^5.5.9|^7.0 I cannot force typehint everything

Afterward I remove the quote and user construction from the computeText function and refactor with getters from the Entities

Then I need to extract the check strpos and str_rerplace logic on another class with an Helper, as I understand the project those check are made with const a lot

