window.dashassistSettings = {
  locale: dashassist_widget_locale,
  type: dashassist_widget_type,
  position: dashassist_widget_position,
  launcherTitle: dashassist_launcher_text,
};

(function(d,t) {
  var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.async=!0;
  g.defer=!0;
  g.src=dashassist_url+"/packs/js/sdk.js";
  s.parentNode.insertBefore(g,s);
  g.onload=function(){
    window.dashassistSDK.run({ websiteToken: dashassist_token, baseUrl: dashassist_url })
  }
})(document,"script");
