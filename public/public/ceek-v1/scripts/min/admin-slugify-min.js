!function($,t,e){"use strict";var l={title:$("#title"),slug:$("#url_slug"),init:function(){l.title.on("keyup",function(){var t=$(this).val();t=t.toLowerCase().replace(/ /g,"-").replace(/[^a-z0-9_\-]/g,""),l.slug.val(t)}),l.slug.on("focusout",function(){var t=$(this).val();t=t.toLowerCase().replace(/ /g,"-").replace(/[^a-z0-9_\-]/g,""),l.slug.val(t)})}};l.init()}(jQuery,this);