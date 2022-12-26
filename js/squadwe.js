window.squadweSettings = {
  locale: squadwe_widget_locale,
  type: squadwe_widget_type,
  position: squadwe_widget_position,
  launcherTitle: squadwe_launcher_text,
};

(function(d,t) {
  var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.async=!0;
  g.defer=!0;
  g.src=squadwe_url+"/packs/js/sdk.js";
  s.parentNode.insertBefore(g,s);
  g.onload=function(){
    window.squadwe.run({ websiteToken: squadwe_token, baseUrl: squadwe_url })
  }
})(document,"script");
