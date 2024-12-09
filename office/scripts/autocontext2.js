if (typeof Begun !== "object") {
	var Begun = {};
}
if (typeof Begun.Error !== "object") {
	Begun.Error = {};
}
if (typeof Begun.loaderCallbacks === "undefined") {
	Begun.loaderCallbacks = [];
}
if (typeof Begun.Scripts !== "object") {
	Begun.Scripts = {
		_baseUrl: window.begun_urls&&window.begun_urls.base_scripts_url?window.begun_urls.base_scripts_url:"http://autocontext.begun.ru/",
		_norm: function(scriptUrl) {
			if (scriptUrl && scriptUrl.indexOf("http") === -1) {
				scriptUrl = this._baseUrl + scriptUrl;
			}
			return scriptUrl;
		},
		importScript: function(scriptUrl) {
			document.write("<scr" + "ipt type=\"text/javascript\" src=\"" + this._norm(scriptUrl) + "\"></scr" + "ipt>");
		}
	};
	Begun.Scripts.importScript("begun_scripts.js");
} else {
	if (typeof Begun.Scripts.addStrictFunction !== "unfedined") {
		begun_load_autocontext();
	}
}

Begun.loaderCallbacks.push(begun_load_autocontext);
function begun_load_autocontext() {

Begun.Scripts.importAllScripts({"begun_template.js": true, "begun_utils.js": true}); 

Begun.Error.send = function(errorMessage, errorUrl, errorLine) {
	var defaultErrorLogger = "http://autocontext.begun.ru/log_errors?";
	var address = window.begun_error_url?window.begun_error_url:defaultErrorLogger;
	var padId = window.begun_auto_pad;
	var img = (new Image()).src = address + "e_msg=" + encodeURIComponent(errorMessage) + "&e_url=" +
		 encodeURI(errorUrl) + "&e_line=" + errorLine +
		"&pad_id=" + padId + "&location=" + encodeURI(document.location);
};

(function() {
if (!Begun.Autocontext) {
	var errorHandler = window.onerror;
	window.onerror = function regErrors(msg, url, line) {
		if (errorHandler && errorHandler instanceof Function) {
			errorHandler();
		}
		if (url && url.search(/autocontext/i) !== -1 ||  msg && msg.search(/Begun/i) !== -1) {
			Begun.Error.send(msg, url, line);
		}
	};
}
})();

Begun.DOM_TIMEOUT = 1;
Begun.REVISION = '$LastChangedRevision: 29067 $';

Begun.Scripts.Callbacks['ac'] = function(fileName) {
if (!Begun.Autocontext && Begun.Scripts.isLastRequired(fileName)) {
	Begun.Autocontext = new function(){
		var _this = this;
		this.dom_change = false;
		this.multiple_feed = true;
		this.scrollers = [];
		this.options = {
			max_blocks_count: 10,
			max_scrollers: 1,
			max_scroll_banners: 10
		};

		var Module = (function() {
			var ext = ['ppcall','scroll','rich','accordion','top','catalog'];
			var loaded = [];
			return {
				isKnown: function(link) {
					var reModule = /auto_(.+)\.js/;
					var parsed = reModule.exec(link);
					return (parsed !== null) && (parsed.length === 2) &&
						Begun.Utils.in_array(ext, parsed[1]);
				},
				isLoaded: function(link) {
					return Begun.Utils.in_array(loaded, link);
				},
				load: function(link) {
					if (!this.isKnown(link) || !this.isLoaded(link)) {
						Begun.Utils.includeScript(link, 'append');
						loaded.push(link);
					}
				},
				getNames: function(what) {
					switch (what) {
						case "loaded":
							return loaded.toString();
						case "all":
						default:
							return ext.toString();
					}
				}
			};
		})();

		this.getModules = Module.getNames;

		var BANNER_600x90_BLOCK_ID = 1;
		var DEFAULT_BLOCK_JS = 'http://autocontext.begun.ru/blocks/{{pad_id}}.{{block_id}}.js';

		this.Strings = {
			urls: {
				begun: 'http://www.begun.ru/',
				autocontext: 'http://autocontext.begun.ru/',
				daemon: 'http://autocontext.begun.ru/context.jsp?', // totally new
				thumbs: 'http://thumbs.begun.ru/',
				blank: 'http://autocontext.begun.ru/img/blank.gif',
				block_js: DEFAULT_BLOCK_JS, // totally new
				block_counter: 'http://autocontext.begun.ru/blockcounter?pad_id={{pad_id}}&block={{block_id}}', // multiblock
				log_banners_counter: 'http://autocontext.begun.ru/blockcounter?data={{data}}&log_visibility=1'
			},
			stubs: {
				place_here: '&#1044;&#1072;&#1090;&#1100; &#1086;&#1073;&#1098;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077;',
				all_banners: '&#1042;&#1089;&#1077; &#1086;&#1073;&#1098;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1103;',
				become_partner: '&#1057;&#1090;&#1072;&#1090;&#1100; &#1087;&#1072;&#1088;&#1090;&#1085;&#1077;&#1088;&#1086;&#1084;'
			},
			contacts: {
				card: '&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1099;',
				ppcall: '&#1047;&#1074;&#1086;&#1085;&#1080;&#1090;&#1100;'
			},
			css: {
				prefix: 'begun',
				block_prefix: 'begun_block_',
				scroll_table_prefix: 'begun_adv_table_',
				scroll_div_prefix: 'begun_adv_common_',
				catalog_search_wrapper: 'begun_catalog_search_span',
				catalog_results_wrapper: 'begun_catalog_results_span',
				catalog_cloud_wrapper: 'begun_catalog_cloud_span',
				thumb: 'begun_adv_thumb',
				favicon: 'begun_adv_fav',
				scroll: 'begun_scroll',
				alco_prefix: 'begun_alco_',
				logo_color: '#622678',
				thumb_def_color: '#118F00',
				thumb_def_color_hover: '#FF0000'
			},
			js: {
				banner_onclick: 'Begun.Autocontext.clickBanner(event, this)' // no 'return' here!
			}
		};

		var is_optimized_block_loading = function(){
			if (window.begun_urls && window.begun_urls.block_js && window.begun_urls.block_js != DEFAULT_BLOCK_JS){
				return false;
			} else {
				return true;
			}
		};

		var OPTIMIZED_BLOCK_LOADING = window.optimized_block_loading ? window.optimized_block_loading : is_optimized_block_loading(); 

		var isBFSApplicable = function(){
			return (window.begun_multiple_feed !== undefined || _this.multiple_feed) && !window.begun_block_ids;
		};

		var LoadingStrategy = function(){};
		LoadingStrategy.prototype = {
			optimized: OPTIMIZED_BLOCK_LOADING,
			loadBlock: function(block_id){},
			parseFeed: function(){}
		};

		// DefaultStrategy
		var DS = function(){};
		DS.prototype = new LoadingStrategy();
		DS.prototype.loadBlock = function(block_id) {
			if (this.optimized) {
				this.block_id = block_id;
				if (!_this.initFeedLoad()) {
					_this.loadFeedDone();
				}
				arguments.callee = LoadingStrategy.loadBlock; // nop
			} else {
				Begun.Utils.includeScript(
					new Begun.Template(_this.Strings.urls.block_js).evaluate({'pad_id': window.begun_auto_pad, 'block_id': block_id}),
					'write' // only write!!
				);
			}
		};
		DS.prototype.parseFeed = function(){
			_this.loadExtraResources();
			if (this.optimized){
				var feed = _this.getFeed();
				if (feed && feed.blocks && this.block_id){
					var block = _this.Blocks.getBlockById(this.block_id, feed.blocks);
					if (block){
						_this.Blocks.push(block);
					}
				}	
			} else {
				// nop
			}
		};

		// ExtraBlockStrategy
		var EBS = function(){};
		EBS.prototype = new LoadingStrategy();
		EBS.prototype.parseFeed = function() {
			_this.loadExtraResources();
		};
		EBS.prototype.loadBlock = function(block_id){
			var feed = _this.getFeed();
			if (feed && feed.blocks){
				_this.resetBannerIndex();
				var sBanners = _this.getShownBanners();
				if (typeof sBanners === "object") {
					sBanners = sBanners.toString();
				} else {
					sBanners = "";
				}
				_this.feedLoad({"banner_filter": sBanners});
			}
			if (this.optimized){
				_this.Blocks.push(window.begun_extra_block);
				this.block_id = block_id;
			} else {
				_this.Blocks.push(window.begun_extra_block);
			}
		};

		//BannersFetchingStrategy
		var BFS = function(){};
		BFS.prototype = new LoadingStrategy();
		BFS.prototype.loadBlock = function(block_id){
			var feed = _this.getFeed();
			if (feed && feed.blocks){
				_this.resetBannerIndex();
				var sBanners = _this.getShownBanners();
				if (typeof sBanners === "object") {
					sBanners = sBanners.toString();
				} else {
					sBanners = "";
				}
				_this.feedLoad({"banner_filter": sBanners});
			}

			if (this.optimized){
			this.block_id = block_id;
			} else {
				(new DS).loadBlock.apply(this, [block_id]);
			}
		};
		BFS.prototype.parseFeed = function(){
			(new DS).parseFeed.apply(this);
		};

		this.getLoadingStrategy = function() {
			if (window.begun_extra_block) {
				if (!arguments.callee.ebs) {
					arguments.callee.ebs = new EBS();
				}
				return arguments.callee.ebs;
			} else if (isBFSApplicable()){
				if (!arguments.callee.bfs) {
					arguments.callee.bfs = new BFS();
				}
				return arguments.callee.bfs;
			} else {
				if (!arguments.callee.ds) {
					arguments.callee.ds = new DS();
				}
				return arguments.callee.ds;
			}
		};
		this.setOptions = function(options){
			Begun.extend(_this.options, options || {});
		};
		this.requestParams = {
			"pad_id": '',
			"block_id": '',
			"n": '',
			"lmt": Date.parse(document.lastModified) / 1000,
			"sense_mode": 'custom', // wtf?
			"ut_screen_width": screen.width || 0,
			"ut_screen_height": screen.height || 0,
			"json": 1, // for json feed!
			"jscall": 'loadFeedDone', // called after feed load
			"condition_id": window.begun_condition_id || '',
			"frm_level": '',
			"frm_top": '',
			"force_js_link": '',
			"hookData": '',
			"misc_id": window.begun_misc_id || window.misc_id,
			"overridden": '',
			"version": '',
			"banner_filter": '',
			"stopwords": window.stopwords || '',
			"begun_self_keywords": window.begun_self_keywords || '',
			"ref": document.referrer,
			"real_refer": document.location
		};
		this.responseParams = {};
		this.prepareRequestParams = function(newValues) {
			var comma = "";
			_this.requestParams.pad_id = window.begun_auto_pad;
			if (self.parent){ // o.begun.ru
				try{ 
						var extra_data = self.parent.document.getElementById('bottomBannerDataId') || null; 
						if (extra_data && extra_data.innerHTML){ 
						_this.requestParams.hookData = extra_data.innerHTML; 
					} 
				}catch(e){}
			}
			var version = Begun.REVISION.replace(/\D/gi, '');
			_this.requestParams.version = version;
			if (typeof(window.begun_js_force_load) != 'undefined' && window.begun_js_force_load) {
				_this.requestParams.force_js_link = Module.getNames('all');
			}
			var frame_level = (function(){
				var level = 0;
				var _parent = self;
				while (_parent !== top && level < 999){
					_parent = _parent.parent;
					level++;
				}
				return level;
			})();
			if (frame_level) {
				_this.requestParams.frm_level = frame_level;
				try {
					_this.requestParams.frm_top = top.location.href;
				} catch(exc) {
					_this.requestParams.frm_top = 'top not accessible';
				}
			}

			if (window.begun_extra_block) {
				var total_banners = window.begun_total_banners || _this.getActualBlockBannersCount();
				if (total_banners) {
					_this.requestParams.n = total_banners;
				} else if (typeof arguments.callee.run === "undefined") {
					_this.requestParams.block_id = BANNER_600x90_BLOCK_ID;
					arguments.callee.run = true;
					comma = ",";
				} else {
					_this.requestParams.block_id = -1;
				}
			} else {
				if (typeof arguments.callee.run === "undefined") {
					_this.requestParams.block_id = BANNER_600x90_BLOCK_ID + "";
					arguments.callee.run = true;
					comma = ",";
				} else {
					_this.requestParams.block_id = "";
				}
				if (window.begun_block_ids) {
					_this.requestParams.block_id += comma + window.begun_block_ids.replace(/\s/g, "");
				} else {
					if (window.begun_block_id && isBFSApplicable()) {
						_this.requestParams.block_id += comma + window.begun_block_id;
					}
				}
			}
			if (window.begun_request_params && window.begun_request_params.constructor === Object) {
				window.begun_request_params.overridden = 1;
				Begun.extend(_this.requestParams, window.begun_request_params);
			}
			if (newValues) {
				Begun.extend(_this.requestParams, newValues);
			}
			var thePad = _this.getPad();
			if (thePad.rq === undefined) {
				thePad.rq = 0;
				thePad.pageId = Math.floor(10000000000000 * Math.random() + (new Date()).valueOf());
			} else {
				thePad.rq++;
			}
			_this.requestParams.rq = (thePad.rq).toString();
			_this.requestParams.page_id = thePad.pageId;
		};
		this.isEventTrackingOn = function() { 
			return _this.responseParams["track_events"]; 
		};
		this.init = function(){
			_this.Customization.init();
			_this.Pads.init();
			_this.initCurrentBlock();
		};
		this.initToolbar = function(debug) {
			if (Begun.Toolbar) {
				Begun.Toolbar.init(debug);
			}
		};
		this.initScrollBlock = function(block){
			if (Begun.Scroller){
				var	setHeight = function(block, scroll_div, scroll_table){
					var banners_count = Number(block.options.banners_count);
					var height = 0;
					for (var i = 0; i < banners_count; i++){
						if (scroll_table.getElementsByTagName('tr')[i]){
							var h = scroll_table.getElementsByTagName('tr')[i].offsetHeight;
							height += h;
						}
					}
					scroll_div.style.height = height + 'px';
					scroll_div.style.overflow = 'hidden';
				};
				var	init = function(block, scroll_div, scroll_table, is_horizontal){
					var banners_count = Number(block.options.banners_count);
					var banners_count_coef = Number(block.options.banners_count_coef) || 1;
					(function() {
						if (!scroll_div.offsetHeight) {
							window.setTimeout(arguments.callee, Begun.DOM_TIMEOUT);
						}
						var scroller = (new Begun.Scroller(
							scroll_table,
							{
								height: scroll_div.offsetHeight,
								banners_count: banners_count,
								banners_count_coef: banners_count_coef,
								is_horizontal: is_horizontal,
								scroll_timeout: (block && block.options && block.options.json && block.options.json.scroll_timeout) || null
							}
						));

						_this.scrollers.push(scroller);
						scroller.start();
					})();
				};
				var scroll_div = Begun.$(_this.Strings.css.scroll_div_prefix + block.id);
				var scroll_table = Begun.$(_this.Strings.css.scroll_table_prefix + block.id);
				var is_horizontal;
				if (!block.scrolling && Number(block.options.use_scroll) && scroll_div && scroll_table) {
					if (_this.Blocks.checkType(block, 'horizontal') || _this.Blocks.checkType(block, '728x90') || _this.Blocks.checkType(block, '468x60')) {
						is_horizontal = true;
					} else {
						is_horizontal = false;
					}
					if (_this.Blocks.checkType(block, 'vertical') || _this.Blocks.checkType(block, 'flat')){
						(function(block, scroll_div, scroll_table, is_horizontal){
							if (scroll_table.offsetHeight){
								setHeight(block, scroll_div, scroll_table);
								scroll_div.style.width = scroll_div.offsetWidth + 'px';
								init(block, scroll_div, scroll_table, is_horizontal);
							} else {
								var func = arguments.callee;
								window.setTimeout(function(){
									func(block, scroll_div, scroll_table, is_horizontal);
								}, Begun.DOM_TIMEOUT);
							}
						})(block, scroll_div, scroll_table, is_horizontal);
					} else if (_this.Blocks.checkType(block, 'horizontal')) {
						(function(block, scroll_div, scroll_table, is_horizontal){
							if (scroll_div.offsetHeight) {
								scroll_div.style.height = (scroll_div.offsetHeight * 0.7) + 'px';
								init(block, scroll_div, scroll_table, is_horizontal);
							} else {
								var func = arguments.callee;
								window.setTimeout(function(){
									func(block, scroll_div, scroll_table, is_horizontal);
								}, Begun.DOM_TIMEOUT);
							}
						})(block, scroll_div, scroll_table, is_horizontal);
					} else {
						init(block, scroll_div, scroll_table, is_horizontal);
					}
					block.scrolling = true;
				}
			}
		};
		this.initAccordionBlock = function(block){
			if (!Begun.Accordion) {
				return false;
			}
			var accordion_div = _this.Blocks.getDomObj(block.id);
			if (!block.is_accordion_processing && Number(block.options.use_accordion) && accordion_div){
				var accordion = (new Begun.Accordion(accordion_div));
				accordion.init();
				block.is_accordion_processing = true;
			}
		};
		this.initAutoTopBlock = function(block){
			if (!Begun.autoTop) {
				return false;
			}
			var auto_top_div = _this.Blocks.getDomObj(block.id);
			if (!block.is_auto_top_processing && _this.Blocks.checkType(block, 'top') && auto_top_div){
				var divs = auto_top_div.getElementsByTagName('div');
				var auto_top_div_inner = null;
				for(var i=0, l=divs.length; i<l; i++) {
					if (Begun.Utils.hasClassName(divs[i], 'begun_collapsable')) {
						auto_top_div_inner = divs[i];
					}
				}
				var body = document.getElementsByTagName('body') && document.getElementsByTagName('body')[0];
				if (Begun.Browser && Begun.Browser.IE && (document.documentElement || body) && auto_top_div_inner) {
					auto_top_div_inner.style.width = (document.documentElement.clientWidth || body.clientWidth) + 'px';
					window.onresize = function() {
						auto_top_div_inner.style.width = (document.documentElement.clientWidth || body.clientWidth) + 'px';
					};
				}
				var auto_top = (new Begun.autoTop(auto_top_div));
				auto_top.init();
				block.is_auto_top_processing = true;
			}
		};
		this.initAutoRichBlock = function(block){
			if (!Begun.richBlocks) {
				return false;
			}
			var rich_blocks_div = _this.Blocks.getDomObj(block.id);
			if (!block.is_rich_blocks_processing && rich_blocks_div){
				Begun.Utils.addClassName(rich_blocks_div, 'begun_auto_rich');
				var options = {};
				if (_this.Blocks.checkType(block, 'vertical')) {
					options = {
						is_equal: true,
						img_width_max: 125,
						img_height_max: 125,
						left_max_default: 10,
						top_max_default: -30
					}
				} else if (_this.Blocks.checkType(block, '728x90')) {
					options = {
						is_equal: true,
						img_width_max: 88,
						img_height_max: 88,
						left_max_default: -10,
						top_max_default: -8
					}
				} else if (_this.Blocks.checkType(block, '120x600')) {
					options = {
						is_equal: true,
						img_width_max: 120,
						img_height_max: 120,
						left_max_default: -10,
						top_max_default: -10
					}
				} else if (_this.Blocks.checkType(block, '160x600')) {
					options = {
						is_equal: true,
						img_width_max: 160,
						img_height_max: 160,
						left_max_default: -10,
						top_max_default: -10
					}
				}
				var rich_blocks = (new Begun.richBlocks(rich_blocks_div, options));
				rich_blocks.init();
				block.is_rich_blocks_processing = true;
			}
		};
		this.initAutoCatalogBlock = function(block){
			if (!Begun.Catalog) {
				return false;
			}
			if (!block.is_catalog_processing) {
				var feed = this.getFeed();
				var catalog = (new Begun.Catalog(block, feed));
				catalog.init();
				block.is_catalog_processing = true;
			}
		};
		this.resetMaxScrollers = function(){
			_this.maxScrollers = _this.options.max_scrollers;
		};
		this.loadExtraResources = function(){
			if (!_this.getFeed()){
				return;
			}
			var links = _this.getFeed().links;
			if (links){
				var i = 0;
				var link = null;
				while (link = links[i]){
					switch(link.type){
						case 'js':
							Module.load(link.url);
							break; 
						case 'css':
							Begun.Utils.includeCSSFile(link.url);
							break; 
						case 'img':
							(new Image()).src = link.url;
							break;
						case 'frame':
							var vars = {url: link.url};
							document.write((new Begun.Template(_this.Tpls.getHTML('link_iframe'))).evaluate(vars));
							break;
						case 'swf':
							var isFlashInstalled = Begun.Utils.checkFlash();
							if (isFlashInstalled) {
								var swf_url = link.url;
								Begun.Utils.addEvent(window, 'load', function() {
									Begun.Utils.includeSWF(swf_url);
								});
							}
							break;
						default:
							(new Image()).src = link.url;
					}
					i++;
				}
			}
		};
		this.draw = function(){
			if (!arguments.callee.run){
				_this.Blocks.init();
			}
			arguments.callee.run = true;
			_this.fillBlocks();
		};
		this.useBlockIdDistr = function(){
			return !!(_this.getBanner('autocontext', 0) && _this.getBanner('autocontext', 0)["block_id"]);
		};
		this.initCurrentBlock = function() {
			if (window.begun_auto_pad !== undefined && window.begun_auto_pad > 0) {
				if (window.begun_block_ids) {
					if (_this.currentIdIndex === undefined) {
						_this.currentIdIndex = 0;
					} else {
						_this.currentIdIndex++;
					}
					var blockIds = window.begun_block_ids.replace(/\s/g,"").split(",");
					if (blockIds.length && blockIds.length > _this.currentIdIndex) {
						_this.printBlockPlace(blockIds[_this.currentIdIndex]);
						_this.getLoadingStrategy().loadBlock(blockIds[_this.currentIdIndex]);
						_this.initFeedLoad();
					}
				} else if (window.begun_block_id !== undefined && window.begun_block_id > 0) {
					if (!window.begun_extra_block || !_this.isOldBlock()) {
						_this.printBlockPlace(window.begun_block_id);
					}
					_this.getLoadingStrategy().loadBlock(window.begun_block_id);
					_this.initFeedLoad();
				}
			}
		};
		this.getActualBlockBannersCount = function(block) {
			if (typeof block === "undefined") {
				if (typeof window.begun_extra_block !== "undefined") {
					block = window.begun_extra_block;
				} else {
					return 0;
				}
			}
			var coef = Math.ceil(Number(block.options.banners_count_coef)) || 1; //may come 0.5, 0.6 and 0.8
			return Number(block.options.banners_count) * coef;
		};
		this.initFeedLoad = function(){
			if (_this.isFeedStarted()){
				return false;
			}
			if (isBFSApplicable() || window.begun_extra_block || !_this.getFeed()) {
				_this.setFeedStarted();
				_this.prepareRequestParams();
				Begun.Utils.includeScript(
					(_this.Strings.urls.daemon + Begun.Utils.toQuery(_this.requestParams)).substring(0, 1524).replace(/%[0-9a-fA-F]?$/, ''),
					'write', // only write!!
					undefined, // callback doesn't work properly in IE
					undefined,
					'begunAds'
				);
				return true;
			}
			return false;
		};
		this.feedLoad = function(paramsUpdate){
			_this.prepareRequestParams(paramsUpdate);
			Begun.Utils.includeScript(
				(_this.Strings.urls.daemon + Begun.Utils.toQuery(_this.requestParams)).substring(0, 1524).replace(/%[0-9a-fA-F]?$/, ''),
				'write', // only write!!
				undefined, // callback doesn't work properly in IE
				undefined,
				'begunAds',
				Begun.Autocontext.Strings.urls.script_timeout_counter
			);
			return true;
		};
		this.getGraphHTML = function(graph_banner, callback, width, height){
			width = width || 240;
			height = height || 400;
			var type = 'img';
			if (("swf" == graph_banner.mime) || ("application/x-shockwave-flash" == graph_banner.mime)){
				type = 'swf';
			} else if (("js" == graph_banner.mime) || ("application/x-javascript" == graph_banner.mime)){
				type = 'js';
				Begun.Utils.includeScript(graph_banner.source, 'append', callback || null);
			}
			var vars = {'url': graph_banner.url, 'source': graph_banner.source, 'width': width, 'height': height};
			return (new Begun.Template(_this.Tpls.getHTML('search_banner_' + type))).evaluate(vars);
		};
		this.initFilledBannersData = function(block) {
			if (block && !block.filled_banners_data) {
				block.filled_banners_data = {
					text  : 0,
					graph : 0,
					code  : 0
				};
			}
		};
		this.insertNonTextBlock = function(block){
			this.initFilledBannersData(block);
			var findBlocks = function(block_id, type){
				var i = 0;
				var obj = [];
				var banner = null;
				while (banner = _this.getBanner(type, i)){
					if (banner.block_id == block_id){
						obj[obj.length] = banner;
					}
					i++;
				}
				return obj;
			};
			var findGraphBlocks = function(type){
				var i = 0;
				var obj = [];
				var banner = null;
				while (banner = _this.getBanner(type, i)){
					obj[obj.length] = banner;
					i++;
				}
				return obj;
			};
			// patch code section
			if (!arguments.callee.code_patched){
				var feed = _this.getFeed();
				if (feed && feed.code && feed.banners && !feed.banners.code){
					feed.banners.code = feed.code;
				}
				arguments.callee.code_patched = true;
			}
			var block_id = block.id;
			var code_banner = findBlocks(block_id, 'code');
			var graph_banner = findGraphBlocks('graph');
			if (code_banner) {
				for(var i=0, l=code_banner.length; i<l; i++) {
					if (code_banner[i].js && code_banner[i].js !='') {
						Begun.Utils.evalScript(code_banner[i].js);
						block.filled_banners_data.code++;
						block.nonTextBannersInserted = true;
					}
				}
			}
			var type = block && block.options && block.options.dimensions && block.options.dimensions.type;
			if (graph_banner){
				for(var i=0, l=graph_banner.length; i<l; i++) {
					if (graph_banner[i].loaded) {
						continue;
					}
					if (!arguments.callee.banner_600x90_inserted && graph_banner[i].block_id && Number(graph_banner[i].block_id) == BANNER_600x90_BLOCK_ID) {
						var html = _this.getGraphHTML(graph_banner[i], null, 600, 90);
						_this.drawTopGraphBanner(html);
						var virtual_block = {
							id: BANNER_600x90_BLOCK_ID
						};
						this.initFilledBannersData(virtual_block);
						virtual_block.filled_banners_data.graph++;
						_this.dispatchBlockDrawCallback(virtual_block);
						graph_banner[i].loaded = true;
						arguments.callee.banner_600x90_inserted = true;
					} else if (graph_banner[i].block_id == block_id || (!graph_banner[i].block_id && type && type == '240x400')) {
						var html = _this.getGraphHTML(graph_banner[i]);
						var block_place = _this.Blocks.getDomObj(block_id);
						if (html && block_place){
							block_place.innerHTML = html;
							block.filled_banners_data.graph++;
							block.nonTextBannersInserted = true;
							graph_banner[i].loaded = true;
							return;
						}
					}
				}
			}
		};
		this.drawTopGraphBanner = function(html){
			var banner_wrapper = Begun.$('begun_top_graph_banner_wrapper');
			if (!banner_wrapper) {
				var bo = document.getElementsByTagName('BODY');
				var banner_wrapper = document.createElement('div');
				banner_wrapper.id = 'begun_top_graph_banner_wrapper';
				bo[0].insertBefore(banner_wrapper, bo[0].firstChild );
			}
			banner_wrapper.innerHTML = (new Begun.Template(_this.Tpls.getHTML('top_graph_banner'))).evaluate({'html':html});
		};
		this.isOldBlock = function() {
			var isPadNew = function(params){
				if (!params || !window.begun_auto_pad) {
					return false;
				}
				return Begun.Utils.in_array(params.split(','), window.begun_auto_pad);
			};
			if (_this.responseParams['old_blocks'] !== undefined && Number(_this.responseParams['old_blocks']) != 0 && typeof begunAutoRun == 'function'){
				var feed = _this.getFeed();
				if (feed && feed.cookies && feed.cookies.js_force_new_pads && isPadNew(feed.cookies.js_force_new_pads)) {
					return false;
				}
				return true;
			}
			return false;
		};
		this.renderOldBlock = function() {
			if (_this.isOldBlock()) {
				begunAutoRun();
				return true;
			}
			return false;
		};
		this.loadFeedDone = function() {
			var extendVisualOptions = function(newVisualOptions) {
				Begun.extend(this.options.visual, newVisualOptions);
			};
			for (var i = 0; i < window.begunAds.blocks.length; i++) {
				window.begunAds.blocks[i].setVisualOptions = extendVisualOptions;
				_this.initFilledBannersData(window.begunAds.blocks[i]);
			}
			_this.getPad().feed = window.begunAds;
			Begun.extend(_this.responseParams, _this.getFeed().params || {});
			if (!_this.renderOldBlock()){
				_this.getLoadingStrategy().parseFeed();
				var first_block = _this.getBlock(0) || null;
				if (first_block && first_block.id){
					_this.insertNonTextBlock(first_block);
				}
				_this.draw(); // run in any case
			}
		};
		this.printBlockPlace = function(block_id){
			var vars = {id: _this.Strings.css.block_prefix + block_id};
			if (document.body) {
				document.write((new Begun.Template(_this.Tpls.getHTML('blck_place'))).evaluate(vars));
			} else {
				document.write("<body>" + (new Begun.Template(_this.Tpls.getHTML('blck_place'))).evaluate(vars) + "</body>");
			}
		};
		this.printDefaultStyle = function(){
			Begun.Utils.includeStyle(_this.Tpls.getCSS('default'), 'write'); // 'append' is killing ie 6
		};
		var getTableColor = function(bgcolor, block_id) {
			if (!bgcolor || bgcolor == 'transparent') {
				var block = _this.Blocks.getDomObj(block_id);
				return getBGColor(block);
			} else {
				return bgcolor;
			}
		};
		var getBGColor = function(block) {
			var bgcolor = Begun.Utils.getStyle(block, 'background-color');
			while(bgcolor == 'transparent') {
				if (block.nodeName == 'BODY') {
					var body_bg = Begun.Utils.getStyle(block, 'background-color');
					if (body_bg == 'transparent') {
						bgcolor = '#FFFFFF';
					} else {
						bgcolor = Begun.Utils.getStyle(block, 'background-color');
					}
					break;
				}
				block = block.parentNode;
				bgcolor = Begun.Utils.getStyle(block, 'background-color');
			}
			return bgcolor;
		};
		var getLogoColor = function(styles, block_id){
			var default_logo_color = _this.Strings.css.logo_color;
			if (styles.block){
				var is_logo_transparent = false;
				if ((styles.block.backgroundColor && styles.block.backgroundColor.toLowerCase() == 'transparent') || !styles.block.backgroundColor) {
					var block = _this.Blocks.getDomObj(block_id);
					var toNumbers = function(str) {
						var ret = [];
						str.replace(/(..)/g, function(str){
							ret.push( parseInt( str, 16 ) );
						});
						return ret;
					};
					var areColorsTooClose = function(c1, c2, delta) {
						for (var i=0; i < arguments.length; i++) {
							if (0 == arguments[i].indexOf('#')) {
								arguments[i] = toNumbers(arguments[i].slice(1));
							} else {
								return false;
							}
						}
						delta = delta || 100;
						return (Math.sqrt((c1[0]-c2[0])*(c1[0]-c2[0]) + (c1[1]-c2[1])*(c1[1]-c2[1]) + (c1[2]-c2[2])*(c1[2]-c2[2])) < delta);
					};
					var convertColor = function (color_string) {
						if (color_string.charAt(0) == '#') {
							color_string = color_string.substr(1,6);
						}
						color_string = color_string.replace(/ /g,'');
						color_string = color_string.toLowerCase();
						var simple_colors={aliceblue:'f0f8ff',antiquewhite:'faebd7',aqua:'00ffff',aquamarine:'7fffd4',azure:'f0ffff',beige:'f5f5dc',bisque:'ffe4c4',black:'000000',blanchedalmond:'ffebcd',blue:'0000ff',blueviolet:'8a2be2',brown:'a52a2a',burlywood:'deb887',cadetblue:'5f9ea0',chartreuse:'7fff00',chocolate:'d2691e',coral:'ff7f50',cornflowerblue:'6495ed',cornsilk:'fff8dc',crimson:'dc143c',cyan:'00ffff',darkblue:'00008b',darkcyan:'008b8b',darkgoldenrod:'b8860b',darkgray:'a9a9a9',darkgreen:'006400',darkkhaki:'bdb76b',darkmagenta:'8b008b',darkolivegreen:'556b2f',darkorange:'ff8c00',darkorchid:'9932cc',darkred:'8b0000',darksalmon:'e9967a',darkseagreen:'8fbc8f',darkslateblue:'483d8b',darkslategray:'2f4f4f',darkturquoise:'00ced1',darkviolet:'9400d3',deeppink:'ff1493',deepskyblue:'00bfff',dimgray:'696969',dodgerblue:'1e90ff',feldspar:'d19275',firebrick:'b22222',floralwhite:'fffaf0',forestgreen:'228b22',fuchsia:'ff00ff',gainsboro:'dcdcdc',ghostwhite:'f8f8ff',gold:'ffd700',goldenrod:'daa520',gray:'808080',green:'008000',greenyellow:'adff2f',honeydew:'f0fff0',hotpink:'ff69b4',indianred :'cd5c5c',indigo :'4b0082',ivory:'fffff0',khaki:'f0e68c',lavender:'e6e6fa',lavenderblush:'fff0f5',lawngreen:'7cfc00',lemonchiffon:'fffacd',lightblue:'add8e6',lightcoral:'f08080',lightcyan:'e0ffff',lightgoldenrodyellow:'fafad2',lightgrey:'d3d3d3',lightgreen:'90ee90',lightpink:'ffb6c1',lightsalmon:'ffa07a',lightseagreen:'20b2aa',lightskyblue:'87cefa',lightslateblue:'8470ff',lightslategray:'778899',lightsteelblue:'b0c4de',lightyellow:'ffffe0',lime:'00ff00',limegreen:'32cd32',linen:'faf0e6',magenta:'ff00ff',maroon:'800000',mediumaquamarine:'66cdaa',mediumblue:'0000cd',mediumorchid:'ba55d3',mediumpurple:'9370d8',mediumseagreen:'3cb371',mediumslateblue:'7b68ee',mediumspringgreen:'00fa9a',mediumturquoise:'48d1cc',mediumvioletred:'c71585',midnightblue:'191970',mintcream:'f5fffa',mistyrose:'ffe4e1',moccasin:'ffe4b5',navajowhite:'ffdead',navy:'000080',oldlace:'fdf5e6',olive:'808000',olivedrab:'6b8e23',orange:'ffa500',orangered:'ff4500',orchid:'da70d6',palegoldenrod:'eee8aa',palegreen:'98fb98',paleturquoise:'afeeee',palevioletred:'d87093',papayawhip:'ffefd5',peachpuff:'ffdab9',peru:'cd853f',pink:'ffc0cb',plum:'dda0dd',powderblue:'b0e0e6',purple:'800080',red:'ff0000',rosybrown:'bc8f8f',royalblue:'4169e1',saddlebrown:'8b4513',salmon:'fa8072',sandybrown:'f4a460',seagreen:'2e8b57',seashell:'fff5ee',sienna:'a0522d',silver:'c0c0c0',skyblue:'87ceeb',slateblue:'6a5acd',slategray:'708090',snow:'fffafa',springgreen:'00ff7f',steelblue:'4682b4',tan:'d2b48c',teal:'008080',thistle:'d8bfd8',tomato:'ff6347',turquoise:'40e0d0',violet:'ee82ee',violetred:'d02090',wheat:'f5deb3',white:'ffffff',whitesmoke:'f5f5f5',yellow:'ffff00',yellowgreen:'9acd32'};
						for (var key in simple_colors) {
							if (color_string == key) {
								color_string = simple_colors[key];
							}
						}
						var color_defs = [
							{
								re: /^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/,
								example: ['rgb(123, 234, 45)', 'rgb(255,234,245)'],
								process: function (bits){
									return [
										parseInt(bits[1]),
										parseInt(bits[2]),
										parseInt(bits[3])
									];
								}
							},
							{
								re: /^(\w{2})(\w{2})(\w{2})$/,
								example: ['#00ff00', '336699'],
								process: function (bits){
									return [
										parseInt(bits[1], 16),
										parseInt(bits[2], 16),
										parseInt(bits[3], 16)
									];
								}
							},
							{
								re: /^(\w{1})(\w{1})(\w{1})$/,
								example: ['#fb0', 'f0f'],
								process: function (bits){
									return [
										parseInt(bits[1] + bits[1], 16),
										parseInt(bits[2] + bits[2], 16),
										parseInt(bits[3] + bits[3], 16)
									];
								}
							}
						];
						for (var i = 0; i < color_defs.length; i++) {
							var re = color_defs[i].re;
							var processor = color_defs[i].process;
							var bits = re.exec(color_string);
							if (bits) {
								channels = processor(bits);
								this.r = channels[0];
								this.g = channels[1];
								this.b = channels[2];
								this.ok = true;
							}
						}
						this.r = (this.r < 0 || isNaN(this.r)) ? 0 : ((this.r > 255) ? 255 : this.r);
						this.g = (this.g < 0 || isNaN(this.g)) ? 0 : ((this.g > 255) ? 255 : this.g);
						this.b = (this.b < 0 || isNaN(this.b)) ? 0 : ((this.b > 255) ? 255 : this.b);

						var r = this.r.toString(16);
						var g = this.g.toString(16);
						var b = this.b.toString(16);
						if (r.length == 1) {
							r = '0' + r;
						}
						if (g.length == 1) {
							g = '0' + g;
						}
						if (b.length == 1) {
							b = '0' + b;
						}
						return '#' + r + g + b;
					};

					var getRealBG = function (bgcolor) {
						var temp_stub = document.createElement('div');
						temp_stub.style.height = '0';
						temp_stub.style.overflow = 'hidden';
						temp_stub.style.backgroundColor = bgcolor;
						document.body.appendChild(temp_stub);
						var real_color = Begun.Utils.getStyle(temp_stub, 'background-color');
						temp_stub.parentNode.removeChild(temp_stub);
						return real_color;
					};
					var bgcolor = getBGColor(block);
					var temp_logo_color = getRealBG(styles.block.borderColor);
					bgcolor = getRealBG(bgcolor);

					bgcolor = convertColor(bgcolor);
					temp_logo_color = convertColor(temp_logo_color);

					if (bgcolor == temp_logo_color || areColorsTooClose(bgcolor, temp_logo_color)) {
						is_logo_transparent = true;
					}
				}
				var is_default_color = ((!styles.block.borderColor || styles.block.borderColor.toLowerCase() == 'transparent') || (styles.block.backgroundColor !== undefined && styles.block.borderColor !== undefined && styles.block.backgroundColor.toLowerCase() == styles.block.borderColor.toLowerCase()));
				return (is_default_color || is_logo_transparent) ? default_logo_color : styles.block.borderColor;
			} else {
				return default_logo_color;
			}
		};
		var prepareColorStyles = function(styles){
			function checkColorDef(obj, prop){
				if (obj !== null && obj !== undefined){
					if (obj[prop] === ""){
						obj[prop] = "transparent";
					}
				}
			}
			
			function checkBgColor(obj){
				checkColorDef(obj, "backgroundColor");
			}
			
			function checkBorderColor(obj){
				checkColorDef(obj, "borderColor");
			}

			function mkTransparentBordersForIE(obj) {
				if (obj !== null && obj !== undefined && Begun.Browser.IE && Begun.Browser.less(7) && obj.borderColor && (obj.borderColor.toLowerCase() == 'transparent' || obj.borderColor == '')){
					obj.borderColor = "pink";
					obj.filter = "chroma(color=pink)";
				}
			}

			checkBgColor(styles.block_hover);
			checkBorderColor(styles.block_hover);
			
			checkBgColor(styles.block);
			checkBorderColor(styles.block);

			mkTransparentBordersForIE(styles.block);
			mkTransparentBordersForIE(styles.block_hover);
		};
		this.printBlockStyle = function(block_id, styles){
			styles = styles || {};
			var vars = {};
			var block = _this.Blocks.getBlockById(block_id);
			vars.block_id = block_id || -1;
			vars.phone_margin_top = 1; // TODO: calc from font-size
			vars.phone_margin_top = styles.domain && styles.domain.fontSize ? styles.domain.fontSize - 9 : 1;
			vars.block_logo_color = getLogoColor(styles, block_id);
			prepareColorStyles(styles);
			if (styles.block && styles.block.backgroundColor) {
				styles.block.backgroundColor = Number(block.options.use_scroll) ? getTableColor(styles.block.backgroundColor, block_id) : styles.block.backgroundColor;
				vars['table:backgroundColor'] = Number(block.options.use_scroll) ? getTableColor(styles.block.backgroundColor, block_id) : 'transparent';
			}
			if (styles.block && styles.block_hover && styles.block_hover.backgroundColor && styles.block_hover.borderColor){
				styles.block_hover.backgroundColor = Number(block.options.use_scroll) ? getTableColor(styles.block_hover.backgroundColor, block_id) : styles.block_hover.backgroundColor;
				vars['table_hover:backgroundColor'] = Number(block.options.use_scroll) ? getTableColor(styles.block_hover.backgroundColor, block_id) : 'transparent';
			}
			for (var key in styles){
				if (styles[key] && styles.hasOwnProperty && styles.hasOwnProperty(key)){
					for (var key2 in styles[key]){
						if (styles[key][key2] && styles[key].hasOwnProperty && styles[key].hasOwnProperty(key2)){
							vars[key + ':' + key2] = typeof styles[key][key2] == 'number' ? styles[key][key2] + 'px' : styles[key][key2];
						}
					}
				}
			}
			vars['thumb:backgroundColor'] = vars['thumb:backgroundColor'] || _this.Strings.css.thumb_def_color;
			var css_text = (new Begun.Template(_this.Tpls.getCSS('block'))).evaluate(vars);
			var css_text_for_ie = (new Begun.Template(_this.Tpls.getCSS('forOperaIE'))).evaluate(vars);
			if (Begun.Browser.IE || Begun.Browser.Opera) {
				css_text += css_text_for_ie;
			}
			Begun.Utils.includeStyle(css_text, 'append', 'begun-block-css-' + block_id); // non-IE with append!!
		};
		this.isFeedStarted = function(){
			return !!_this.getPad().feed_started;
		};
		this.setFeedStarted = function(){
			_this.getPad().feed_started = true;
		};
		this.getBannerIndex = function(){
			return _this.getPad().banner_index;
		};
		this.setBannerIndex = function(index){
			_this.getPad().banner_index = index;
		};
		this.incBannerIndex = function(){
			_this.setBannerIndex(_this.getBannerIndex() + 1);
		};
		this.resetBannerIndex = function(){
			_this.setBannerIndex(0);
		};
		this.registerShownBanner = function(shownBanner){
			var bannerId = shownBanner && shownBanner.banner_id;
			if (!bannerId) {
				return;
			}
			if (!_this.banners) {
				_this.banners = [bannerId];
			} else {
				_this.banners.push(bannerId);
			}
		};
		this.getShownBanners = function(){
			return _this.banners;
		};
		this.getPad = function(pad_id){
			return _this.Pads.getPad(pad_id || window.begun_auto_pad);
		};
		this.getFeed = function(){
			return _this.getPad().feed;
		};
		this.getBlock = function(index){
			var padBlocks = _this.getPad().blocks;
			if (padBlocks.length > index) {
				return _this.getPad().blocks[index];
			} else {
				return null;
			}
		};
		this.getBlocks = function(pad_id){
			var blocks = []; 
			if (pad_id){
				blocks = _this.getPad(pad_id).blocks;
			} else {
				var pads = _this.Pads.getPads();
				for(var i=0, l=pads.length; i<l; i++) {
					for(var j=0, n=pads[i].blocks.length; j<n; j++) {
						blocks.push(pads[i].blocks[j]);
					}
				}
			}
			return blocks;
		};
		this.getBanner = function(type, index, pad_id){
			try{
				return _this.getPad(pad_id).feed.banners[type][index];
			} catch(e){
				return null;
			}
		};
		this.getBanners = function(){
			return _this.getFeed().banners;
		};
		this.getStub = function(type){
			return _this.getFeed().stubs[type] || null;
		};
		this.getRichPictureSrc = function(banner){
			var banner_id = banner.banner_id + '';
			if (_this.Strings.urls.rich_picture_big && _this.Strings.urls.rich_picture_small && banner_id) {
				var small = (new Begun.Template(_this.Strings.urls.rich_picture_small)).evaluate({banner_id: banner_id});
				var big = (new Begun.Template(_this.Strings.urls.rich_picture_big)).evaluate({banner_id: banner_id});
				return {
					small: small,
					big: big
				};
			}
			var src = _this.responseParams['thumbs_src'] ? 'http://' + _this.responseParams['thumbs_src'] + '/' : _this.Strings.urls.thumbs;
			var stc_s;
			var src_b;
			if (banner_id && banner_id.length > 3){
				src += 'rich/';
				src += banner_id.charAt(banner_id.length - 2);
				src += '/' + banner_id.charAt(banner_id.length - 1);
				src += '/' + banner_id;
				src_s =  src + 's';
				src_b =  src + 'b';
			} else {
				src_s = _this.Strings.urls.blank;
				src_b = src_s;
			}
			if (banner.images && banner.images.richpreview) {
				src_s = banner.images.richpreview;
			}
			if (banner.images && banner.images.rich) {
				src_b = banner.images.rich;
			}
			return {
				small: src_s,
				big: src_b
			};
		};
		this.getThumbSrc = function(banner, fake){
			var src = _this.responseParams['thumbs_src'] ? 'http://' + _this.responseParams['thumbs_src'] + '/' : _this.Strings.urls.thumbs;
			var banner_id = banner.banner_id + '';
			if (banner_id && banner_id.length > 3){
				var thematic = banner.thematics ? (banner.thematics.split(',')[0] + '') : '1';
				src += banner_id.charAt(banner_id.length - 2);
				src += '/' + banner_id.charAt(banner_id.length - 1);
				src += '/' + banner_id + '.jpg';
				src += '?t=' + thematic + '&r=' + banner_id.charAt(banner_id.length - 3);
			} else {
				src = src + 'empty.jpg';
			}
			if (banner.images && banner.images.thematic) {
				src = banner.images.thematic;
			}
			if (Begun.Browser.IE && Begun.Browser.version() <= 6 && fake) {
				src = _this.Strings.urls.blank;
			}
			if (banner.images && banner.images.sitepreview) {
				src = banner.images.sitepreview;
			}
			return src;
		};
		this.getFaviconSrc = function(banner){
			var src = _this.responseParams['thumbs_src'] ? 'http://' + _this.responseParams['thumbs_src'] + '/' : _this.Strings.urls.thumbs;
			var banner_id = banner.banner_id + '';
			if (banner_id && banner_id.length > 3){
				src += 'favicon/';
				src += banner_id.charAt(banner_id.length - 2);
				src += '/' + banner_id.charAt(banner_id.length - 1);
				src += '/' + banner_id + '.jpg';
			} else {
				src = _this.Strings.urls.blank;
			}
			if (banner.images && banner.images.favicon) {
				src = banner.images.favicon;
			}
			return src;
		};
		this.getBannerContacts = function(banner, block, fullDomain) {
			var result = this.getBannerCardPPcallData(banner, block);
			var banner_contacts_names = result.is_card_exist ? ['geo'] : ['domain', 'geo'];
			return result.banner_contacts.concat(this.getBannerDomainGeoHTML(banner, block, banner_contacts_names, fullDomain));
		};
		this.getBannerCardPPcallData = function(banner, block){
			var banner_contacts = [];
			var is_card_exist = false;
			var cards_mode = banner['cards_mode'];
			var is_ppcall = banner['ppcall'];
			var vars = {};
			function _card(use_phone){
				vars.card_text = _this.Strings.contacts.card;
				vars.url = _this.addMisc2URL(block.options.misc_id, banner.card);
				vars.phone = use_phone ? (new Begun.Template(_this.Tpls.getHTML('bnnr_phone'))).evaluate(vars) : '';
				vars.no_phone_class = use_phone ? '' : 'begun_adv_phone_no_icon';
				banner_contacts.push((new Begun.Template(_this.Tpls.getHTML('bnnr_card'))).evaluate(vars));
				is_card_exist = true;
			}
			function _ppcall(use_phone){
				vars.ppcall_text = _this.Strings.contacts.ppcall;
				vars.banner_index = _this.getBannerIndex();
				vars.pad_id = window.begun_auto_pad || '';
				vars.phone = use_phone ? (new Begun.Template(_this.Tpls.getHTML('bnnr_phone'))).evaluate(vars) : '';
				banner_contacts.push((new Begun.Template(_this.Tpls.getHTML('bnnr_ppcall'))).evaluate(vars));
			}
			if (cards_mode == 'Card' && is_ppcall == false){
				_card(true);
			} else if (cards_mode == 'Card' && is_ppcall == true){
				_ppcall(true);
				_card(false);
			} else if (cards_mode == 'Url' && is_ppcall == false){
				// nop
			} else if (cards_mode == 'Url' && is_ppcall == true){
				_ppcall(true);
			} else if (cards_mode == 'Card, Url' && is_ppcall == false){
				_card(true);
			} else if (cards_mode == 'Card, Url' && is_ppcall == true){
				_ppcall(true);
				_card(false);
			}
			return {
				banner_contacts : banner_contacts,
				is_card_exist	: is_card_exist
			};
		};
		this.getBannerDomainGeoHTML = function(banner, block, banner_contacts_names, fullDomain) {
			var banner_contacts = [];
			var i = 0;
			var banner_contacts_name = null;
			var vars = {};
			while (banner_contacts_name = banner_contacts_names[i]){
				vars[banner_contacts_name] = banner[banner_contacts_name];
				vars.status = banner.status;
				vars.url = _this.addMisc2URL(block.options.misc_id, banner.url);
				vars.fullDomain = fullDomain;
				if (vars[banner_contacts_name]) {
					banner_contacts.push((new Begun.Template(_this.Tpls.getHTML('bnnr_' + banner_contacts_name))).evaluate(vars));
				}
				i++;
			}
			return banner_contacts;
		};
		this.addMisc2URL = function(misc_id, url){
			return (misc_id > 0 ? url + '&misc2=' + (Number(misc_id) << 8) : url);
		};
		this.clickBanner = function(click_event, orig_elem){
			click_event = click_event || window.event;
			if (click_event.done){
				return;
			}
			var curr_elem = click_event.target || click_event.srcElement;
			var isInsideTag = function(child_elem, parent_tag){
				var child_elem_parent = child_elem;
				do{
					if (child_elem_parent.tagName && child_elem_parent.tagName.toUpperCase() == parent_tag.toUpperCase()){
						return true;
					}
				}while (child_elem_parent = child_elem_parent.parentNode);
				return false;
			};
			if (curr_elem.tagName.toUpperCase() == 'A' || isInsideTag(curr_elem, 'A')){
				click_event.done = true;
				_this.Callbacks.dispatch('banner', 'click', curr_elem);
				if (this.isEventTrackingOn()) { 
					_this.clickHandler(orig_elem).apply(_this);
				}
			} else if (orig_elem.getAttribute('_url')){
				var anyLink = curr_elem.getElementsByTagName("a")[0];
				if (anyLink && anyLink.click !== undefined) {
					if (click_event.preventDefault !== undefined) {
						click_event.preventDefault();
					} else {
						click_event.returnValue = false;
					}
					if (click_event.stopPropagation !== undefined) {
						click_event.stopPropagation();
					} else {
						click_event.cancelBubble = true;
					}
					anyLink.click();
				} else {
					_this.Callbacks.dispatch('banner', 'click', curr_elem);
					if (this.isEventTrackingOn()) {
						_this.clickHandler(orig_elem).apply(_this);
					}
					window.open(orig_elem.getAttribute('_url'));
				}
			}
		};
		this.getBannerHTML = function(banner, block, block_banner_count){
			var BANNER_SHORT_PART_LENGTH = 13;
			function prepareBannerMode(banner) {
				banner = banner || {};
				var possible_cards_modes = ['Card, Url', 'Card', 'Url'];
				if ((!banner['cards_mode']) || !Begun.Utils.in_array(possible_cards_modes, banner['cards_mode'])){
					banner['cards_mode'] = 'Card, Url';
				}
				if (!banner['url'] && !banner['card']){
					return {};
				}
				if (!banner['url'] && banner['card']){
					banner['cards_mode'] = 'Card';
				}
				if (banner['url'] && !banner['card']){
					banner['cards_mode'] = 'Url';
				}
				if (banner['cards_mode'] == 'Card'){
					banner['url'] = banner['card'];
				}
				return banner;
			}

			banner = prepareBannerMode(banner);
			if (banner) {
				if (banner.domain) {
					banner.fullDomain = banner.domain;
					if (banner.domain.match(/&#x426;&#x435;&#x43d;&#x430;: /)) {
						banner.status = banner.domain;
					} else {
						banner.status = 'http://' + banner.domain + '/';
						if (banner.domain.length > 2 * BANNER_SHORT_PART_LENGTH + 3) {
							banner.domain = banner.domain.substring(0, BANNER_SHORT_PART_LENGTH)
								+ '&hellip;' + banner.domain.slice(-BANNER_SHORT_PART_LENGTH);
						}
					}
				} else {
					banner.fullDomain = banner.domain = banner.status = '';
				}
				banner.domain = banner.domain.replace(/\./g, '.&shy;');
				var banner_contacts = _this.getBannerContacts(banner, block, banner.fullDomain);
				var vars = {};
				Begun.extend(vars, banner);
				vars.contact = banner_contacts.join(_this.Tpls.getHTML('bnnr_glue'));
				vars.url = _this.addMisc2URL(block.options.misc_id, banner.url);
				vars.onclick = _this.Strings.js.banner_onclick;
				vars.block_id = block.id;
				vars.banner_id = banner.banner_id;
				vars.id = block_banner_count || 0;
				vars.descr = vars.descr.replace(/(\,|\.|\?|\!|\:)(\S\D)/g,'$1 $2');
				vars.thumb = Number(block.options.show_thumbnails) ? (new Begun.Template(_this.Tpls.getHTML('bnnr_thumb'))).evaluate({url: banner.url, src: _this.getThumbSrc(banner,true), 
					pngfix: (Begun.Browser.IE && Begun.Browser.version() <= 6) ? 'style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''+_this.getThumbSrc(banner,false)+'\', sizingMethod=\'image\');width:56px !important;"' : '',
					bgcolor: (typeof block.options.visual.thumb != 'undefined') ? block.options.visual.thumb.backgroundColor : _this.Strings.css.thumb_def_color, 
					bgcolor_hover: (typeof block.options.visual.thumb_hover != 'undefined') ? block.options.visual.thumb_hover.backgroundColor : _this.Strings.css.thumb_def_color_hover}) : '';
				vars.banner_width = Math.round(100 / Number(_this.getActualBlockBannersCount(block))) + '%';
				if (_this.Blocks.checkType(block, 'square') && block.options.json && block.options.json.col) {
					vars.banner_width = Math.round(100 / Number(block.options.json.col)) + '%';
				}
				vars.css_favicon = (Number(block.options.show_favicons) && !Number(block.options.show_thumbnails)) ? _this.Strings.css.favicon : '';
				vars.favicon = Number(block.options.show_favicons) && !Number(block.options.show_thumbnails) ? 'style="zoom:1;background-image:url(' + _this.getFaviconSrc(banner) + ') !important;background-repeat:no-repeat !important;"' : '';
				vars.bnnr_alco = _this.checkBannerViewType(banner, 'alco') ? (new Begun.Template(_this.Tpls.getHTML('bnnr_alco_attn'))).evaluate({}) : '';
				if (_this.checkBannerViewType(banner, 'rich')) {
					var pictures = _this.getRichPictureSrc(banner);
					vars.picture = (new Begun.Template(_this.Tpls.getHTML('bnnr_picture'))).evaluate({src: pictures.small, big_photo_src:  pictures.big, url: banner.url});
					var is_use_rich = '_rich';
				} else {
					vars.picture = vars.thumb;
					var is_use_rich = '';
				}
				var is_use_accordion = Number(block.options.use_accordion) ? '_use_accordion' : '';
				return (new Begun.Template(_this.Tpls.getHTML('banner_' + block.options.dimensions.type.toLowerCase() + is_use_rich + is_use_accordion))).evaluate(vars);
			} else {
				return '';
			}
		};
		this.checkBannerViewType = function(banner, viewtype) {
			return Begun.Utils.inList(banner.view_type, viewtype); 
		};
		this.getTableWithAds = function(blockId) {
			var getSingleTable = function(id) {
				var element = _this.Blocks.getDomObj(id);
				if (!element) {
					return undefined;
				}
				var tables = element.getElementsByTagName("table");
				for (var i = 0; i < tables.length; i++) {
					if (tables[i].className && tables[i].className.indexOf("begun_adv_table") > -1) {
						return tables[i];
					}
				}
				return undefined;
			};
			switch(typeof blockId) {
				case "number":
				case "string":
					return getSingleTable(blockId);
				default:
					var blocks = _this.getBlocks();
					var res = [];
					for (var i = 0; i < blocks.length; i++) {
						var tbl = getSingleTable(blocks[i].id);
						if (tbl) {
							res.push(tbl);
						}
					}
					return (res.length > 0?res:undefined);
			}
		};
		this.updateUrlParamInTd = function(td, param, value) {
			var updateParamInLink = function(link, param, value) {
				var hrefText = link.getAttribute("href");
				var linkContent = link.firstChild.nodeValue;
				var newHref;
				if (hrefText.indexOf("?") === -1) {
					hrefText = hrefText + "?addingParams";
				}
				if (hrefText.indexOf("&" + param + "=") === -1) {
					newHref = hrefText + "&" + param + "=" + value;
					link.setAttribute("href", newHref);
					link.firstChild.nodeValue = linkContent;
					td.setAttribute("_url", newHref);
				} else {
					var firstPosition = hrefText.indexOf("&" + param + "=") + param.length + 1;
					var lastPosition = hrefText.indexOf("&", firstPosition + 1);
					if (lastPosition === -1) {
						newHref = hrefText.substring(0, firstPosition + 1) + value;
						link.setAttribute("href", newHref);
						link.firstChild.nodeValue = linkContent;
						td.setAttribute("_url", newHref);
					} else {
						newHref = hrefText.substring(0, firstPosition + 1) + value + hrefText.slice(lastPosition);
						link.setAttribute("href", newHref);
						link.firstChild.nodeValue = linkContent;
						td.setAttribute("_url", newHref);
					}
				}
			};
			var linksInTd = td.getElementsByTagName("a");
			for (var i = 0, len = linksInTd.length; i < len; i++) {
				updateParamInLink(linksInTd[i], param, value);
			}
		};
		this.getBlockHTML = function(banners_html_arr, block){
			if (!banners_html_arr) {
				return '';
			}
			var banners_html = banners_html_arr.join('');
			var stub_display = Number(_this.responseParams['stub']) ? '' : 'none';
			if (block.options && (typeof block.options.json != 'undefined') && (typeof block.options.json.stub != 'undefined')) {
				stub_display = Number(block.options.json.stub) ? '' : 'none';
			}
			var logo_display = '';
			if (block.options && (typeof block.options.json != 'undefined') && (typeof block.options.json.logo != 'undefined')) {
				logo_display = (Number(block.options.json.logo)) ? '' : 'none';
			}
			var extended_block_class = '';
			if (stub_display == 'none' && logo_display == 'none') {
				extended_block_class = 'begun_extended_block';
			} else if (stub_display == 'none' && logo_display == '') {
				extended_block_class = 'begun_extended_block_with_logo';
			}
			// TODO: how many stubs and which ones
			var vars = {};
			var block_hover_html = '';
			var block_opts = block.options.visual || {};
			if (block_opts.block && block_opts.block_hover && block_opts.block_hover.backgroundColor && block_opts.block_hover.borderColor){
				vars.bgcolor_over = block_opts.block_hover.backgroundColor;
				vars.brdcolor_over = block_opts.block_hover.borderColor;
				vars.bgcolor_out = block_opts.block.backgroundColor || 'transparent';
				vars.brdcolor_out = block_opts.block.borderColor || 'transparent';
				vars.block_id = block.id;
				block_hover_html = (new Begun.Template(_this.Tpls.getHTML('blck_hover'))).evaluate(vars);
			}
			vars = {
				block_id: block.id,
				block_hover: block_hover_html,
				banners: banners_html,
				banners_count:	banners_html_arr.length,
				//begun_url_colspan: 3,
				scroll_div_id: _this.Strings.css.scroll_div_prefix + block.id,
				scroll_table_id: _this.Strings.css.scroll_table_prefix + block.id,
				block_width: Number(block.options.dimensions.width) ? Number(block.options.dimensions.width) + 'px' : '',
				block_scroll_class: Number(block.options.use_scroll) ? _this.Strings.css.scroll : '',
				begun_url: _this.Strings.urls.begun,
				become_partner_display: stub_display,
				become_partner_url: _this.getStub('become_partner'),
				become_partner_text: _this.Strings.stubs.become_partner,
				place_here_display: stub_display,
				place_here_url: _this.getStub('place_here'),
				place_here_text: _this.Strings.stubs.place_here,
				all_banners_display: stub_display,
				all_banners_url: _this.getStub('all_banners'),
				all_banners_text: _this.Strings.stubs.all_banners,
				css_thumbnails: Number(block.options.show_thumbnails) ? _this.Strings.css.thumb : '',
				logo_display: logo_display,
				extended_block_class: extended_block_class,
				block_alco: block.is_alco ? (new Begun.Template(_this.Tpls.getHTML('block_alco'))).evaluate({}) : '',
				begun_alco_id: block.is_alco ? _this.Strings.css.alco_prefix + block.id : ''
			};
			var is_use_accordion = Number(block.options.use_accordion) ? '_use_accordion' : '';
			return (new Begun.Template(_this.Tpls.getHTML('block_' + block.options.dimensions.type.toLowerCase() + is_use_accordion))).evaluate(vars);
		};
		this.clickHandler = function(targetTd) {
			return function() {
				var nowTime = (new Date).valueOf();
				this.updateUrlParamInTd(targetTd, "click_time", nowTime);
				this.updateUrlParamInTd(targetTd, "frame_level", _this.requestParams.frm_level);
			};
		};
		this.printBlock = function(banners_html, block) {
			if (_this.isOldBlock()) {
				return;
			}
			if (banners_html.length){
				var regEvents = function() {
					if (!_this.isEventTrackingOn()) {
						return undefined;
					}
					var mouseOverHandler = function(targetTd) {
						return function(e) {
							if (!e) {
								var e = window.event;
							}
							var relTarget = e.relatedTarget || e.fromElement;
							if (relTarget === targetTd) {
								return;
							}
							var tdElements = targetTd.getElementsByTagName("*");
							for (var i = 0; i < tdElements.length; i++) {
								if (tdElements[i] === relTarget) {
									return;
								}
							}
							if (!arguments.callee.count) {
								arguments.callee.count = 1;
							}
							var nowTime = (new Date).valueOf();
							_this.updateUrlParamInTd(targetTd, "mouseover_time", nowTime);
							_this.updateUrlParamInTd(targetTd, "mouseover_count", arguments.callee.count++);
						};
					};
					var mouseDownHandler = function(targetTd) {
						return function() {
							var nowTime = (new Date).valueOf();
							_this.updateUrlParamInTd(targetTd, "mousedown_time", nowTime);
						};
					};
					var tds = _this.getTableWithAds(block.id).getElementsByTagName("td");
					var showTime = (new Date).valueOf();
					for (var i = 0; i < tds.length; i++) {
						_this.updateUrlParamInTd(tds[i], "show_time", showTime);
						Begun.Utils.addEvent(tds[i], "mouseover", mouseOverHandler(tds[i]));
						Begun.Utils.addEvent(tds[i], "mousedown", mouseDownHandler(tds[i]));
					}
				};
				var elem = _this.Blocks.getDomObj(block.id);
				// might be also null in bad html (all browsers are affected)
				if (!elem){
					return false;
				}
				this.setExtraBlockResponseParams(block);
				_this.dom_change = true;
				var html = _this.getBlockHTML(banners_html, block);
				var show = showDefault = function(elem, html){
					elem.innerHTML = html;
					_this.dom_change = false;
					regEvents();
				};

				// fix most common partner mistakes for ie
				if (Begun.Browser.IE){
					show = function(elem, html){
						var n = elem.cloneNode(true);
						n.innerHTML = html;
						elem.parentNode.insertBefore(n);
						elem.parentNode.removeChild(elem);
						_this.dom_change = false;
						regEvents();
					};
					var appendTableCell = function(tr, elem){
						if (tr.offsetHeight){
							var td = document.createElement('td');
							tr.appendChild(td);
							td.innerHTML = elem.outerHTML;
							show(td.firstChild, html);
							elem.parentNode.removeChild(elem);
						} else {
							var func = arguments.callee;
							window.setTimeout(function(){
								func(tr, elem);
							}, Begun.DOM_TIMEOUT);
						}
					};
					var parent = null;
					if ((parent = elem.parentNode) && (parent.tagName) && (Begun.Utils.in_array(['ol', 'ul', 'li'], parent.tagName.toLowerCase()))){
						window.setTimeout(function(){
							var parent2 = parent.parentNode;
							parent2.insertBefore(elem, parent);
							showDefault(elem, html);
						}, Begun.DOM_TIMEOUT);
					} else if ((parent) && (parent = elem.parentNode.parentNode) && (parent.tagName)){
						try{
							show(elem, html);
						}catch(e){
							switch (parent.tagName.toLowerCase()){
								case 'table':
									var tr = document.createElement('tr');
									window.setTimeout(function(){
										parent.lastChild.appendChild(tr); // append to (implied) tbody
										appendTableCell(tr, elem);
									}, Begun.DOM_TIMEOUT);
									break;
								case 'tr':
									window.setTimeout(function(){
										appendTableCell(parent, elem);
									}, Begun.DOM_TIMEOUT);
									break;
								case 'thead':
								case 'tbody':
								case 'tfoot':
									var tr = document.createElement('tr');
									window.setTimeout(function(){
										parent.appendChild(tr); // append to thead/tbody/tfoot
										appendTableCell(tr, elem);
									}, Begun.DOM_TIMEOUT);
									break;
								default:
									_this.dom_change = false;
							}
						}
					} else {
						try{
							show(elem, html);
						}catch(e){
							_this.dom_change = false;
						}
					}
				} else {
					show(elem, html);
				}
				return true;
			} else {
				return false;
			}
		};
		this.hideBlock = function(block_id) {
			var elem = _this.Blocks.getDomObj(block_id);
			if (elem){
				elem.innerHTML = '';
			}
		};
		this.dispatchBlockDrawCallback = function(block) {
			if (block && !block.drawCallbackDispatched) {
				_this.Callbacks.dispatch('block', 'draw', _this, [block]);
				block.drawCallbackDispatched = true;
			}
		};
		this.fillBlocks = function() {
			var isValidSquareBlock = function(block) {
				return (_this.Blocks.checkType(block, 'square') && block.options.json && block.options.json.row && block.options.json.col);
			};
			var block = null;
			var block_index = 0;
			var out_of_banners = false;
			var pad = _this.getPad();
			if (typeof arguments.callee.blocksHandled === "undefined") {
				arguments.callee.blocksHandled = [];
			}
			while ((block = _this.getBlock(block_index)) && (!out_of_banners)) {
				if (!Begun.Utils.in_array(arguments.callee.blocksHandled, block)) {
					_this.Callbacks.dispatch('block', 'predraw', _this, [block]);
					if (block.options && block.options.visual) {
						_this.printBlockStyle(block.id, block.options.visual);
					}
					arguments.callee.blocksHandled.push(block);
				}
				if (block.loaded || _this.Blocks.isDeleted(block)){
					block_index++;
					continue;
				}
				if (block.nonTextBannersInserted) {
					_this.dispatchBlockDrawCallback(block);
					block_index++;
					continue;
				}
				if (Begun.Utils.inList((block.options && block.options.block_options), 'JSCatalog')) {
					var initAutoCatalog = function(block) {
						if (!Begun.Catalog || !Begun.$(_this.Strings.css.catalog_search_wrapper) || !Begun.$(_this.Strings.css.catalog_results_wrapper) || !Begun.$(_this.Strings.css.catalog_cloud_wrapper) || _this.dom_change){
							window.setTimeout(function() {
								initAutoCatalog(block);
							}, Begun.DOM_TIMEOUT);
						} else {
							_this.initAutoCatalogBlock(block);
						}
					};
					initAutoCatalog(block);
					block.loaded = true;
					block_index++;
					continue;
				}
				var banners_html = [];
				var block_banner_count = 0;
				var banner = null;
				this.setExtraBlockResponseParams(block);
				if (Number(block.options.use_scroll) && (Number(block.options.use_accordion) || _this.Blocks.checkType(block, 'top') || _this.Blocks.checkType(block, 'rich'))){
					block.options.use_scroll = 0;
				}
				var banners_count;
				var banner_html;
				if (_this.useBlockIdDistr()) {
					var i = 0;
					banners_count = _this.getActualBlockBannersCount(block);
					while (banner = _this.getBanner('autocontext', i)){
						if (banner.block_id && banner.block_id == block.id){
							banner_html = '';
							if (isValidSquareBlock(block)) {
								if (block_banner_count % Number(block.options.json.col) == 0) {
									banner_html += '<tr>';
								}
								banner_html += _this.getBannerHTML(banner, block, (block_banner_count + 1));
								if ((block_banner_count + 1) % Number(block.options.json.col) == 0) {
									banner_html += '</tr>';
								}
							} else {
								banner_html = _this.getBannerHTML(banner, block, (block_banner_count + 1));
							}
							if (banner_html){
								banners_html.push(banner_html);
								block.filled_banners_data.text++;
								_this.Callbacks.dispatch('banner', 'draw', _this, [banner]);
								_this.registerShownBanner(banner);
							}
							if (_this.checkBannerViewType(banner, 'alco')) {
								block.is_alco = true;
							}
							block_banner_count++;
						}
						i++;
					}
				} else {
					banners_count = _this.getActualBlockBannersCount(block);
					while (block_banner_count < banners_count){
						banner = _this.getBanner('autocontext', _this.getBannerIndex()) || null;
						if (banner) {
							if (_this.checkBannerViewType(banner, 'alco')) {
								block.is_alco = true;
							}
							banner_html = '';
							if (isValidSquareBlock(block)) {
								if (block_banner_count % Number(block.options.json.col) == 0) {
									banner_html += '<tr>';
								}
								banner_html += _this.getBannerHTML(banner, block, (block_banner_count + 1));
								if ((block_banner_count + 1) % Number(block.options.json.col) == 0) {
									banner_html += '</tr>';
								}
							} else {
								banner_html = _this.getBannerHTML(banner, block, (block_banner_count + 1));
							}
							if (banner_html){
								banners_html.push(banner_html);
								block.filled_banners_data.text++;
								_this.Callbacks.dispatch('banner', 'draw', _this, [banner]);
								_this.registerShownBanner(banner);
							}
						} else {
							out_of_banners = true;
							break;
						}
						block_banner_count++;
						_this.incBannerIndex();
					}
				}
				if (isValidSquareBlock(block) && block_banner_count < banners_count && block_banner_count != 0) {
					for(block_banner_count; block_banner_count<banners_count; block_banner_count++) {
						var banner_html = '';
						if (block_banner_count % Number(block.options.json.col) == 0) {
							banner_html += '<tr>';
						}
						banner_html += '<td>&nbsp;</td>';
						if ((block_banner_count + 1) % Number(block.options.json.col) == 0) {
							banner_html += '</tr>';
						}
						banners_html.push(banner_html);
					}
				}
				if (_this.printBlock(banners_html, block)) {
					block.loaded = true;
				}
				_this.dispatchBlockDrawCallback(block);
				_this.loadModules(block);
				block_index++;
			}
		};
		this.loadModules = function(block) {
			var initExtraModule = function(objName, func, object) {
				if (!window.Begun[objName] || _this.dom_change) {
					window.setTimeout(function() {
						initExtraModule(objName, func, object);
					}, Begun.DOM_TIMEOUT);
				} else {
					func(object);
				}
			};
			if (Number(block.options.use_scroll)) {
				initExtraModule('Scroller', _this.initScrollBlock, block);
			} else if (Number(block.options.use_accordion)) {
				initExtraModule('Accordion', _this.initAccordionBlock, block);
			} else if (_this.Blocks.checkType(block, 'top')) {
				initExtraModule('autoTop', _this.initAutoTopBlock, block);
			} else if (_this.Blocks.checkType(block, 'rich') || _this.Blocks.checkViewType(block, 'rich')) {
				initExtraModule('richBlocks', _this.initAutoRichBlock, block);
			}
			var feed = this.getFeed();
			if (feed && feed.debug) {
				initExtraModule('Toolbar', _this.initToolbar, feed.debug);
			}
		};
		this.nullGlobalBlockParams = function(){
			window.begun_block_id = null;
			window.begun_extra_block = null;
		};
		this.setExtraBlockResponseParams = function(block){
			block.options.use_scroll = typeof block.options.use_scroll != 'number' ? Number(_this.responseParams['autoscroll']) : block.options.use_scroll;
			block.options.show_thumbnails = typeof block.options.show_thumbnails != 'number' || isNaN(block.options.show_thumbnails) ? Number(_this.responseParams['thumbs']) : block.options.show_thumbnails;
		};
	};
	
	(function(){
		var ac = Begun.Autocontext;
		
		ac.Monitor = new function(){
			var _this = this;
			this.init = function() {
				Begun.Utils.addEvent(window, 'load', function() {
					_this.prepare();
				});
				Begun.Utils.addEvent(window, 'unload', function() {
					_this.send(_this.data || 'none');
				});
				Begun.Utils.addEvent(window, 'scroll', function() {
					_this.count();
				});
			};
			this.prepare = function() {
				var pads = ac.Pads.getPads();
				if (pads.length === 0) {
					Begun.Error.send("pads are empty", document.location, -1);
					return;
				}
				for (var n = 0, ln = pads.length; n < ln; n++) {
					for (var i = 0, length = pads[n].blocks.length; i < length; i++) {
						var dom_obj = ac.Blocks.getDomObj(pads[n].blocks[i].id);
						if (ac.Blocks.isDeleted(pads[n].blocks[i]) || !dom_obj) {
							continue;
						}
						pads[n].blocks[i].hidden = false;
						pads[n].blocks[i].dom_obj = dom_obj;
						var banners_id = [];
						var tds = dom_obj.getElementsByTagName('td');
						for (var k=0, l=tds.length; k<l; k++) {
							if (tds[k].getAttribute('_banner_id') && tds[k].getAttribute('_banner_id')!='' && typeof (tds[k].getAttribute('_banner_id'))!=undefined) {
								banners_id[banners_id.length] = tds[k].getAttribute('_banner_id');
							}
						}
						pads[n].blocks[i].banners_id = banners_id.join(',');
					}
				}
				this.count();
			};
			this.count = function() {
				var data = [];
				var visibleBannersData = [];
				var pads = ac.Pads.getPads();
				for(var n=0, ln=pads.length; n<ln; n++) {
					var hiddenBannersObj = [];
					var visibleBannersObj = [];
					for(var i=0, l=pads[n].blocks.length; i<l; i++) {
						var viewportheight = Begun.Utils.countWindowSize().height;
						var scrolledOfY = Begun.Utils.getScrollXY().y;
						var dom_obj = pads[n].blocks[i].dom_obj;
						if (dom_obj){
							if (!pads[n].blocks[i].alreadySeen) {
								if (!pads[n].blocks[i].banners_id) {
									pads[n].blocks[i].alreadySeen = true;
									continue;
								}
								var block_top_pos = Begun.Utils.findPos(dom_obj) && Begun.Utils.findPos(dom_obj).top;
								if (block_top_pos > viewportheight + scrolledOfY) {
									pads[n].blocks[i].hidden = true;
									hiddenBannersObj[hiddenBannersObj.length] = {
										id: pads[n].blocks[i].id,
										banners_id: pads[n].blocks[i].banners_id
									};
								} else {
									pads[n].blocks[i].hidden = false;
									visibleBannersObj[visibleBannersObj.length] = {
											id: pads[n].blocks[i].id,
											banners_id: pads[n].blocks[i].banners_id
									}
									pads[n].blocks[i].alreadySeen = true;
									var blockAlreadySeen = ac.Blocks.getBlockById(pads[n].blocks[i].id, hiddenBannersObj);
									delete blockAlreadySeen;
								}
							}
						}
					}
					if (hiddenBannersObj.length) {
						data[data.length] = {
							pad_id: pads[n].pad_id,
							hidden: hiddenBannersObj
						};
					} else {
						data = [];
					}
					if (visibleBannersObj.length) {
						this.send(Begun.Utils.toJSON({
							pad_id: pads[n].pad_id,
							visible: visibleBannersObj
						}));
					}
				}
				if (data.length) {
					this.data = data.length ? Begun.Utils.toJSON(data) : 'none';
				}
			};
			this.send = function(data) {
				var src = ac.Strings.urls.log_banners_counter;
				Begun.Utils.includeCounter(src, {
					data : data
				});
			};
		};

		ac.Pads = new function(){
			var pads = [];
			this.init = function(){
				if (window.begun_auto_pad !== undefined && !this.getPad()){
					this.push(window.begun_auto_pad);
				}
			};
			this.push = function(pad_id){
				pads[pads.length] = {
					pad_id: pad_id,
					feed: null,
					blocks: [],
					banner_index: 0,
					feed_started: false
				};
			};
			this.getPad = function(pad_id){
				pad_id = pad_id || window.begun_auto_pad;
				for(var i=0, l=pads.length; i<l; i++) {
					if (pads[i].pad_id == pad_id) {
						return pads[i];
					}
				}
				return null;
			};
			this.getPads = function(){
				return pads;
			};
		};

		ac.Blocks = new function(){
			this.init = function(){ 
				ac.resetBannerIndex(); 
				ac.resetMaxScrollers(); 
			}; 
			this.push = function(elem, pad_id){
				if (window.begun_auto_pad !== undefined && elem.id){
					this.loadBlockCounter(window.begun_auto_pad, elem.id);
				}
				var blocks = ac.getPad(pad_id).blocks;
				if (window.begun_extra_block) {
					blocks[0] = elem;
				} else {
					blocks[blocks.length] = elem;
				}
				if (!ac.isFeedStarted()){
					ac.initFeedLoad();
				} else if (!!ac.getFeed()){
					ac.insertNonTextBlock(elem);
					ac.draw();
				}
				ac.nullGlobalBlockParams();
			};
			this.del = function(block_id, pad_id){
				var block = null;
				var i = 0;
				var blocks = ac.getPad(pad_id).blocks;
				while (block = blocks[i]){
					if (block.id == block_id){
						blocks[i].id = -1;
						blocks[i].options.banners_count = 0;
						break;
					}
					i++;
				}
			};
			this.deleteAll = function(pad_id){
				var blocks = ac.getPad(pad_id).blocks;
				while (blocks.pop()){}
			};
			this.isDeleted = function(block){
				block.id == -1 && block.options.banners_count == 0;
			};
			this.pushAll = function(blocks, pad_id){
				this.deleteAll(pad_id);
				this.init();

				var block = null;
				var i = 0;
				while (block = blocks[i]){
					this.push(block);
					i++;
				}
			};
			this.loadBlockCounter = function(pad_id, block_id){
				if (this.length > 0){
					Begun.Utils.includeCounter(ac.Strings.urls.block_counter, {'pad_id': pad_id, 'block_id': block_id});
				}
			};
			this.getBlockById = function(block_id, blocks, pad_id){
				var block = null;
				var i = 0;
				blocks = blocks || ac.getPad(pad_id).blocks;
				while (block = blocks[i]){
					if (block.id == block_id){
						return block;
					}
					i++;
				}
				return null;
			};
			this.getDomObj = function(block_id){
				return Begun.$(ac.Strings.css.block_prefix + block_id) || null;
			};
			this.checkType = function(block, type) {
				return (block && block.options && block.options.dimensions && block.options.dimensions.type && block.options.dimensions.type.toLowerCase() == type);
			};
			this.checkViewType = function(block, viewtype) {
				return Begun.Utils.inList((block.options && block.options.view_type), viewtype);
			};
		};

		ac.Callbacks = new function(){
			var _callbacks = {};
			var _extend = function(destination, source){
				for (var property in source){
					if (typeof source[property] == 'object'){
						var new_obj = {};
						for (var property2 in source[property]){
							if (typeof source[property][property2] == 'function'){
								if ((destination[property] !== undefined) && (typeof destination[property][property2] == 'function')){
									new_obj[property2] = function(old_func, new_func, property2){
										return function(args){
											old_func.apply(property2 == 'click' ? this : ac, [args]);
											new_func.apply(property2 == 'click' ? this : ac, [args]);
										};
									}(destination[property][property2], source[property][property2], property2);
								} else {
									new_obj[property2] = function(func, property2){
										return function(args){
											func.apply(property2 == 'click' ? this : ac, [args]);
										};
									}(source[property][property2], property2);
								}
							}
						}
						destination[property] = new_obj;
					}
				}
				return destination;
			};
			this.register = function(callbacks){
				_extend(_callbacks, callbacks);
			};
			this.dispatch = function(obj, method, context_obj, args) {
				if (_callbacks[obj] && typeof _callbacks[obj][method] == 'function') {
					args = args || [];
					_callbacks[obj][method].apply(context_obj || this, args);
				} else {
					return null;
				}
			};
			this.getCallbacks = function(){
				return _callbacks;
			};
		};

		ac.Tpls = new function(){
			var css = {};
			css['default'] = '\
.begun_adv *, .begun_adv *:link, .begun_adv *:visited, .begun_adv *:hover, .begun_adv *:active {\
background: none; /* no !important for hover */\
border: none; /* no !important for hover */\
width: auto; \
height: auto; \
/*height: auto !important;*/ /* used for scrolling */\
}\
#begun-default-css {display:none !important;}\
';
			css['block'] = '.begun_adv * {clear:none !important;color:#000 !important;float:none !important;margin:0 !important;padding:0 !important;letter-spacing:normal !important;word-spacing:normal !important;z-index:auto !important;font-size:12px !important;font:normal normal 12px Arial,sans-serif !important;text-transform:none !important;list-style:none !important;position:static !important;text-indent:0 !important;visibility:visible !important;}.begun_adv .begun_adv_common tr,.begun_adv .begun_adv_common td,.begun_adv .begun_adv_common a,.begun_adv .begun_adv_common b,.begun_adv .begun_adv_common div,.begun_adv .begun_adv_common span,.begun_adv .begun_adv_sys *,.begun_adv .begun_adv_all *{background:none !important;border:none !important;}#begun_block_{{block_id}} {height:auto !important;}#begun_block_{{block_id}} .begun_adv {font:12px/18px Arial,sans-serif !important;color:#000 !important;text-align:left !important;}#begun_block_{{block_id}} .begun_adv b {font-weight:bold !important;display:inline !important;}#begun_block_{{block_id}} .begun_adv td {font-size:11px !important;}#begun_block_{{block_id}} .begun_adv,#begun_block_{{block_id}} .begun_adv table,#begun_block_{{block_id}} .begun_adv td,#begun_block_{{block_id}} .begun_adv div {padding:0 !important;text-align:left !important;}#begun_block_{{block_id}} .begun_adv table {border:none !important;border-collapse:collapse !important;}#begun_block_{{block_id}} .begun_adv td {vertical-align:middle !important;}#begun_block_{{block_id}} .begun_adv.begun_adv_hor td,#begun_block_{{block_id}} .begun_adv.begun_collapsable td,#begun_block_{{block_id}} .begun_adv_fix_hor td {vertical-align:top !important;}#begun_block_{{block_id}} .begun_adv_sys {width:100% !important;}#begun_block_{{block_id}} .begun_adv_sys_sign_up {vertical-align:middle !important;}#begun_block_{{block_id}} .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_all {text-align:left !important;}#begun_block_{{block_id}} .begun_adv_bullit {color:#aaa !important;}#begun_block_{{block_id}} .begun_adv_title,#begun_block_{{block_id}} .begun_adv_text {white-space:normal !important;display:block !important;}#begun_block_{{block_id}} .begun_adv_title,#begun_block_{{block_id}} .begun_adv_title * {font-weight:bold !important;}#begun_block_{{block_id}} .begun_adv_sys_logo div {vertical-align:middle !important;}#begun_block_{{block_id}} .begun_adv_sys_logo a:link,#begun_block_{{block_id}} .begun_adv_sys_logo a:visited,#begun_block_{{block_id}} .begun_adv_sys_logo a:hover,#begun_block_{{block_id}} .begun_adv_sys_logo a:active {color:{{block_logo_color}} !important;text-decoration:none !important;font-weight:bold !important;font-style:italic !important;}#begun_block_{{block_id}} .begun_adv_sys_logo a {margin-top:-1px !important;}#begun_block_{{block_id}} .begun_adv_sys_sign_up div {text-align:right !important;}#begun_block_{{block_id}} .begun_adv_ext .begun_adv_sys_logo,#begun_block_{{block_id}} .begun_adv_ext .begun_adv_sys_logo * {font-size:13px !important;line-height:17px !important;}#begun_block_{{block_id}} .begun_adv_hor,#begun_block_{{block_id}} .begun_adv_hor .begun_adv_table {width:100% !important;}#begun_block_{{block_id}} .begun_adv_hor .begun_adv_cell,#begun_block_{{block_id}} .begun_collapsable .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_hor .begun_adv_all {padding:0 16px 0 0 !important;}#begun_block_{{block_id}} .begun_adv_ver .begun_adv_cell .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_ver .begun_adv_all {padding:5px 2px 4px 5px !important;}#begun_block_{{block_id}} .begun_adv_ext .begun_adv_sys_logo div {width:3.8em !important;height:2.7ex !important;left:-4px !important;position:relative !important;top:-2px !important;}#begun_block_{{block_id}} .begun_adv_ext .begun_adv_text {padding:2px 0 4px 0 !important;}#begun_block_{{block_id}} .begun_adv_ext .begun_adv_contact span {padding-right:0.2em !important;}#begun_block_{{block_id}} .begun_adv.begun_adv_ext.begun_adv_hor .begun_adv_sys_logo,#begun_block_{{block_id}} .begun_adv.begun_adv_ext.begun_collapsable .begun_adv_sys_logo {width:100% !important;}#begun_block_{{block_id}} .begun_adv_ext.begun_adv_ver .begun_adv_sys_sign_up {padding-right:5px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_cell {padding:0 5px 0 9px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_fix .begun_adv_cell * {font-size:11px !important;line-height:11px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_title {font-size:12px !important;line-height:13px !important;margin-bottom:2px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_title * {font-size:12px !important;line-height:13px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_text,#begun_block_{{block_id}} .begun_adv_fix .begun_adv_text * {font-size:11px !important;line-height:12px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_sys_logo,#begun_block_{{block_id}} .begun_adv_fix .begun_adv_sys_logo * {font-size:13px !important;line-height:17px !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_all,#begun_block_{{block_id}} .begun_adv_fix .begun_adv_all *,#begun_block_{{block_id}} .begun_adv_fix .begun_adv_sys_sign_up,#begun_block_{{block_id}} .begun_adv_fix .begun_adv_sys_sign_up * {font:9px/11px Tahoma,Arial,sans-serif !important;}#begun_block_{{block_id}} .begun_adv_fix {overflow:hidden !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_sys_logo {position:relative !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_sys_logo div {height:17px !important;float:left !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_common {overflow:hidden !important;}#begun_block_{{block_id}}.begun_auto_rich .begun_adv_fix .begun_adv_common {overflow:visible !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_text {padding:2px 0 !important;}#begun_block_{{block_id}} .begun_adv_fix .begun_adv_contact span {padding-right:2px !important;}#begun_block_{{block_id}} .begun_adv_fix_ver .begun_adv_sys_logo,#begun_block_{{block_id}} .begun_adv_ext .begun_adv_sys_logo {padding-left:9px !important;}#begun_block_{{block_id}} .begun_adv_fix_ver .begun_adv_sys_logo div {width:51px !important;}#begun_block_{{block_id}} .begun_adv_fix_ver .begun_adv_sys_sign_up div {width:93% !important;}#begun_block_{{block_id}} .begun_adv_fix_ver .begun_adv_all {height:18px !important;padding:2px 0 0 9px !important;}#begun_block_{{block_id}} .begun_adv_fix_ver .begun_adv_block {margin:5px 0 !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_common {margin-top:7px !important;text-align:left !important;}#begun_block_{{block_id}} .begun_adv_468x60 .begun_adv_common {margin-top:5px !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_block {margin:0 !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_sys_logo {width:53px !important;float:left !important;padding:0 !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_sys_logo div {width:53px !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_sys_sign_up {width:53px !important;float:left !important;clear:left !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_sys_sign_up div {padding-left:4px !important;text-align:left !important;}#begun_block_{{block_id}} .begun_adv_table {position:relative !important;}#begun_block_{{block_id}} .begun_adv_fix_hor .begun_adv_table {margin-left:60px !important;display:block !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_common {zoom:1 !important;}#begun_block_{{block_id}} .begun_adv_240x400 {width:240px !important;height:400px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_scroll {height:358px !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_scroll {height:283px !important;}#begun_block_{{block_id}} .begun_adv_468x60 {width:468px !important;height:60px !important;}#begun_block_{{block_id}} .begun_adv_468x60 .begun_adv_sys_sign_up {margin-top:2px !important;}#begun_block_{{block_id}} .begun_adv_468x60 .begun_adv_sys_logo a {padding-left:4px !important;}#begun_block_{{block_id}} .begun_adv_468x60 .begun_adv_text {padding-bottom:4px !important;}#begun_block_{{block_id}} .begun_adv_468x60 .begun_adv_text * {line-height:10px !important;}#begun_block_{{block_id}} .begun_adv_728x90 {width:728px !important;height:90px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_sys_sign_up {margin-top:4px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_sys_logo a {padding-left:4px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_text {padding-bottom:4px !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_scroll {height:560px !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_scroll {height:560px !important;}#begun_block_{{block_id}} .begun_adv_ext .begun_adv_cell .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_ext .begun_adv_all {padding:5px 2px 4px 5px !important;}#begun_block_{{block_id}} .begun_adv.begun_adv_ext.begun_collapsable .begun_adv_sys_sign_up div,#begun_block_{{block_id}} .begun_adv.begun_adv_ext.begun_adv_hor .begun_adv_sys_sign_up div {white-space:nowrap !important;margin-left:25px !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_fav {padding-left:22px !important;background-position:left 1px !important;background-repeat:no-repeat !important;}#begun_block_{{block_id}} .begun_adv .banners_count_1 .begun_adv_fav {padding-left:0 !important;background-position:-1000px -1000px !important;}#begun_block_{{block_id}} .begun_adv_fav .begun_adv_title a {background-position:-1000px -1000px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_fav .begun_adv_title ,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_fav .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_fav div.begun_adv_contact {margin-left:22px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_fav .begun_adv_title a {margin-left:-22px !important;padding-left:22px !important;background-position:left 1px !important;background-repeat:no-repeat !important;}#begun_block_{{block_id}} .begun_adv_text,#begun_block_{{block_id}} .begun_adv_text * {color:#000 !important;}#begun_block_{{block_id}} .begun_adv_block {border:none !important;cursor:pointer !important;cursor:hand !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_adv_cell *,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_cell * {font-size:10px !important;line-height:10px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_text *,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_text *,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_text * {font-size:12px !important;line-height:13px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_adv_text *,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_text * {font-size:11px !important;line-height:12px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_title *,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_title * {font-size:14px !important;line-height:14px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_adv_title,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_adv_title *,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_title,#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_title * {font-size:13px !important;line-height:13px !important;}#begun_block_{{block_id}} .begun_adv_728x90 td.begun_adv_cell {width:50% !important;}#begun_block_{{block_id}} .begun_scroll {overflow:hidden !important;}#begun_block_{{block_id}} .begun_scroll,#begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common {position:relative !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_block {width:106px !important;overflow:hidden !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_block {width:146px !important;overflow:hidden !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_cell .begun_adv_phone * {font-size:1px !important;}#begun_block_{{block_id}} .begun_adv_phone {width:12px !important;margin:1px 3px 0 0 !important;position:absolute !important;top:0 !important;left:0 !important;}#begun_block_{{block_id}} .begun_adv_phone_wrapper {padding-left:15px !important;white-space:nowrap !important;position:relative !important;display:inline-block !important;_display:inline !important;zoom:1 !important;}#begun_block_{{block_id}} .begun_adv_phone_wrapper.begun_adv_phone_no_icon {padding-left:0 !important;}#begun_block_{{block_id}} div.begun_adv_contact > .begun_adv_phone {margin:0 5px 0 0 !important;}#begun_block_{{block_id}} .begun_adv_phone b {border:#118f00 solid 0 !important;height:1px !important;font-size:1px !important;line-height:1px !important;display:block !important;overflow:hidden !important;}#begun_block_{{block_id}} .begun_adv_phone .p0,#begun_block_{{block_id}} .begun_adv_phone .p1,#begun_block_{{block_id}} .begun_adv_phone .p3,#begun_block_{{block_id}} .begun_adv_phone .p5,#begun_block_{{block_id}} .begun_adv_phone .p8 {background-color:#118f00 !important;}#begun_block_{{block_id}} .begun_adv_phone .p1,#begun_block_{{block_id}} .begun_adv_phone .p7,#begun_block_{{block_id}} .begun_adv_phone .p8 {margin:0 1px !important;}#begun_block_{{block_id}} .begun_adv_phone .p2,#begun_block_{{block_id}} .begun_adv_phone .p7 {border-width:0 4px !important;}#begun_block_{{block_id}} .begun_adv_phone .p3,#begun_block_{{block_id}} .begun_adv_phone .p6 {margin:0 2px !important;}#begun_block_{{block_id}} .begun_adv_phone .p0 {margin:0 3px !important;}#begun_block_{{block_id}} .begun_adv_phone .p4 {border-width:0 3px !important;}#begun_block_{{block_id}} .begun_adv_phone .p5 {margin:0 4px !important;}#begun_block_{{block_id}} .begun_adv_phone .p6 {border-width:0 2px !important;}#begun_block_{{block_id}} .begun_adv_phone .p8 {height:2px !important;}#begun_block_{{block_id}} .begun_adv_phone b {border-color:{{domain:color}} !important;}#begun_block_{{block_id}} .begun_adv_phone .p0,#begun_block_{{block_id}} .begun_adv_phone .p1,#begun_block_{{block_id}} .begun_adv_phone .p3,#begun_block_{{block_id}} .begun_adv_phone .p5,#begun_block_{{block_id}} .begun_adv_phone .p8 {background-color:{{domain:color}} !important;}#begun_block_{{block_id}} .begun_adv_phone {font-size:11px !important;line-height:11px !important;margin-top:{{phone_margin_top}} px !important;}#begun_block_{{block_id}} .begun_adv_120x600 {width:120px !important;height:600px !important;}#begun_block_{{block_id}} .begun_adv_160x600 {width:160px !important;height:600px !important;}#begun_block_{{block_id}} .begun_adv_title a,#begun_block_{{block_id}} .begun_adv_title a * {color:{{title:color}} !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_title a:hover,#begun_block_{{block_id}} .begun_adv .begun_adv_title a:hover * {color:#f00 !important;color:{{title_hover:color}} !important;}#begun_block_{{block_id}} .begun_adv_title,#begun_block_{{block_id}} .begun_adv_title * {font-size:{{title:fontSize}} !important;}#begun_block_{{block_id}} .begun_adv_all,#begun_block_{{block_id}} .begun_adv_all * {color:{{domain:color}} !important;font-size:{{domain:fontSize}} !important;}#begun_block_{{block_id}} .begun_adv_text,#begun_block_{{block_id}} .begun_adv_text * {color:{{text:color}} !important;font-size:{{text:fontSize}} !important;text-decoration:none !important;}#begun_block_{{block_id}} .begun_adv_contact,#begun_block_{{block_id}} .begun_adv_contact a,#begun_block_{{block_id}} .begun_adv_contact span {color:{{domain:color}} !important;font-size:{{domain:fontSize}} !important;}#begun_block_{{block_id}} .begun_adv_sys_sign_up,#begun_block_{{block_id}} .begun_adv_sys_sign_up * {color:{{domain:color}} !important;font-size:{{domain:fontSize}} !important;}#begun_block_{{block_id}} .begun_adv_contact a {color:{{domain:color}} !important;text-decoration:none !important;display:inline !important;}#begun_block_{{block_id}} .begun_adv_contact span {display:inline !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_thumb .begun_thumb {margin:0 !important;float:left !important;position:relative !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_thumb .begun_thumb img {margin:0px auto 5px 10px !important;float:left !important;width:56px !important;height:42px !important;position:absolute !important;top:8px !important;left:0 !important;z-index:20 !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_rich .begun_adv_image {float:left !important;margin-right:10px !important;top:8px !important;width:70px !important;height:70px !important;position:relative !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_thumb .begun_thumb img {top:1px !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_rich .begun_adv_image {top:1px !important;}#begun_block_{{block_id}} .begun_adv_ver .begun_adv_rich .begun_adv_image {top:5px !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_thumb .begun_adv_block {margin-left:80px !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_rich .begun_adv_block {margin-left:80px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_block {width:140px !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich .begun_adv_image,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich .begun_adv_image {float:none !important;top:0 !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_thumb,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_thumb {margin-bottom:5px !important;float:none !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_thumb img,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_thumb img {margin:0 !important;float:none !important;width:56px !important;height:42px !important;position:relative !important;top:5px !important;left:0 !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_adv_block,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich .begun_adv_block,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_adv_block,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich .begun_adv_block {margin-left:0px !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common {height:283px !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .begun_adv_common {height:230px !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common table {height:100% !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common.banners_count_1 {height:auto !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common.banners_count_1 table {height:auto !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common {height:361px !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .begun_adv_common {height:321px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common table {height:100% !important;width:100% !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common.banners_count_1 {height:auto !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common.banners_count_1 table {height:auto !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common {height:553px !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common table {height:100% !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_1,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_2 {height:auto !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_1 table,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_2 table {height:auto !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common {height:558px !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common table {height:100% !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_1,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_2 {height:auto !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_1 table,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_2 table {height:auto !important;}#begun_block_{{block_id}} .begun_adv_flat,#begun_block_{{block_id}} .begun_adv_flat .begun_adv_common,#begun_block_{{block_id}} .begun_adv_flat .begun_adv_table {width:100% !important;}#begun_block_{{block_id}} .begun_adv_flat .begun_adv_title {display:inline !important;}#begun_block_{{block_id}} .begun_adv_flat .begun_adv_text {display:inline !important;margin-left:10px !important;}#begun_block_{{block_id}} .begun_adv_flat .begun_adv_fav {padding-bottom:1px !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_cell * {font-size:13px !important;line-height:14px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_thumb,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_thumb *,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_rich,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_rich * {text-align:left !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_phone {margin-top:2px !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_text * {font-size:15px !important;line-height:16px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_thumb .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_thumb.begun_adv_text *,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_rich .begun_adv_text,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_rich .begun_adv_text * {text-align:left !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_title * {font-size:17px !important;line-height:19px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_thumb .begun_adv_title,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_thumb .begun_adv_title *,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_rich .begun_adv_title,#begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_rich .begun_adv_title * {text-align:left !important;} #begun_block_{{block_id}} .begun_adv_728x90 .banners_count_1 .begun_adv_table {margin-left:0 !important;display:table !important;width:92% !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_cell * {font-size:12px !important;line-height:14px !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_phone {margin-top:2px !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_text * {font-size:13px !important;line-height:15px !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_200x300 .banners_count_2 .begun_adv_title * {font-size:15px !important;line-height:17px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_cell,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_cell * {font-size:11px !important;line-height:11px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_phone {margin-top:2px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_text,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_text * {font-size:11px !important;line-height:12px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_title,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_title * {font-size:12px !important;line-height:13px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_cell .begun_adv_phone ,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_200x300 .banners_count_2 .begun_adv_cell .begun_adv_phone * {font-size:1px !important;line-height:1px !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_cell * {font-size:14px !important;line-height:16px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_phone {margin-top:3px !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_text * {font-size:16px !important;line-height:19px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_200x300 .banners_count_1 .begun_adv_title * {font-size:18px !important;line-height:23px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common.banners_count_1 {height:283px !important;} #begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common.banners_count_1 table {height:100% !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_cell * {font-size:13px !important;line-height:15px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_phone {margin-top:3px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_text * {font-size:14px !important;line-height:17px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_title * {font-size:15px !important;line-height:17px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_cell,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_cell * {font-size:12px !important;line-height:14px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_phone {margin-top:2px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_text,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_text * {font-size:13px !important;line-height:16px !important;} #begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_title,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_240x400 .banners_count_3 .begun_adv_title * {font-size:14px !important;line-height:13px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_cell * {font-size:13px !important;line-height:17px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_phone {margin-top:4px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_text * {font-size:14px !important;line-height:19px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_2 .begun_adv_title * {font-size:16px !important;line-height:18px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_cell * {font-size:15px !important;line-height:19px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_phone {margin-top:5px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_text * {font-size:16px !important;line-height:19px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_1 .begun_adv_title * {font-size:18px !important;line-height:25px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common.banners_count_1 {height:361px !important;} #begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common.banners_count_1 table {height:100% !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_cell * {font-size:10px !important;line-height:11px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_phone {margin-top:2px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_cell .begun_adv_text,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_cell .begun_adv_text * {font-size:11px !important;line-height:12px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_4 .begun_adv_title * {font-size:12px !important;line-height:13px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_cell * {font-size:11px !important;line-height:14px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_phone {margin-top:3px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_text * {font-size:12px !important;line-height:14px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_3 .begun_adv_title * {font-size:14px !important;line-height:18px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_cell * {font-size:12px !important;line-height:14px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_phone {margin-top:4px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_text * {font-size:13px !important;line-height:15px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_2 .begun_adv_title * {font-size:14px !important;line-height:18px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_2 {height:553px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_2 table {height:100% !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_cell * {font-size:13px !important;line-height:17px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_phone {margin-top:5px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_text * {font-size:14px !important;line-height:17px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_120x600 .banners_count_1 .begun_adv_title * {font-size:15px !important;line-height:19px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_1 {height:553px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.banners_count_1 table {height:100% !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb *,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich * {font-size:10px !important;line-height:11px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_adv_text,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_adv_text *,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich .begun_adv_text,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich .begun_adv_text * {font-size:11px !important;line-height:12px !important;} #begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_adv_title,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_thumb .begun_adv_title *,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich .begun_adv_title,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_rich .begun_adv_title * {font-size:12px !important;line-height:13px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_cell *,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_cell * {font-size:13px !important;line-height:16px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_phone,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_phone {margin-top:4px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_text *,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_text * {font-size:14px !important;line-height:18px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_3 .begun_adv_title *,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_2 .begun_adv_title * {font-size:15px !important;line-height:20px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_cell * {font-size:15px !important;line-height:18px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_phone {margin-top:5px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_text,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_text * {font-size:16px !important;line-height:20px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_title,#begun_block_{{block_id}} .begun_adv_160x600 .banners_count_1 .begun_adv_title * {font-size:18px !important;line-height:23px !important;text-align:center !important;} #begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb *,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich * {font-size:11px !important;line-height:12px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_adv_text,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_adv_text *,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich .begun_adv_text,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich .begun_adv_text * {font-size:12px !important;line-height:13px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_adv_title,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_thumb .begun_adv_title *,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich .begun_adv_title,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_rich .begun_adv_title * {font-size:13px !important;line-height:14px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_2,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_1 {height:558px !important;} #begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_2 table,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.banners_count_1 table {height:100% !important;}#begun_block_{{block_id}} .begun_adv_accordion .accordion_section .begun_adv_cell .begun_adv_block .begun_adv_title,#begun_block_{{block_id}} .begun_adv_accordion .accordion_section .begun_adv_cell .begun_adv_block .section {border:1px solid transparent !important;_border:none !important;}#begun_block_{{block_id}} .begun_adv_accordion .accordion_section .begun_adv_cell {vertical-align:top !important;}#begun_block_{{block_id}} .begun_adv_accordion .begun_adv_block {margin:5px 0 0 !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_contact,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_contact *,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_cell,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_cell * {font-size:11px !important;line-height:11px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_text,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_rich .begun_adv_text * {font-size:12px !important;line-height:13px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_rich .begun_adv_title,#begun_block_{{block_id}} .begun_adv_240x400 .banners_count_3 .begun_adv_rich .begun_adv_title * {font-size:13px !important;line-height:14px !important;}#begun_top_graph_banner {margin:2px 0px 2px 0px !important;border:none !important;border-spacing:0px !important;background-color:#fff !important;}#begun_top_graph_banner .begun_top_graph_banner_left_col,#begun_top_graph_banner .begun_top_graph_banner_right_col {height:90px !important;width:50% !important;background-color:#fff !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_cell .begun_adv_phone_wrapper .begun_adv_phone * {font-size:1px !important;}#begun_block_{{block_id}} .begun_adv_ver .begun_adv_phone {margin-top:3px !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.begun_extended_block,#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.begun_extended_block,#begun_block_{{block_id}} .begun_adv_200x300 .begun_adv_common.begun_extended_block,#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common.begun_extended_block {height:100% !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_adv_table.begun_extended_block,#begun_block_{{block_id}} .begun_adv_468x60 .begun_adv_table.begun_extended_block {margin-left:0px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_adv_common.begun_extended_block_with_logo {height:382px !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_adv_common.begun_extended_block_with_logo,#begun_block_{{block_id}} .begun_adv_120x600 .begun_adv_common.begun_extended_block_with_logo {height:582px !important;}#begun_block_{{block_id}} .begun_adv .begun_alco_message {padding:12px 10px 15px 20px !important;position:relative !important;top:0px !important;font-size:9px !important;line-height:1.2em !important;color:#333333 !important;text-transform:uppercase !important;background-color:#F0F0F0 !important;}#begun_block_{{block_id}} .begun_adv .begun_alco_message span.begun_alco_attention,#begun_block_{{block_id}} .begun_adv .begun_adv_title span.begun_alco_attention {color:#FF0000 !important;}#begun_block_{{block_id}} .begun_adv .begun_alco_message span.begun_alco_attention {left:10px !important;position:absolute !important;top:10px !important;}#begun_block_{{block_id}} .begun_adv .begun_adv_title span.begun_alco_attention {margin-left:5px !important;font-weight:bold !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_alco_message {padding-bottom:20px !important;width:10% !important;float:right !important;}#begun_block_{{block_id}} .begun_adv_728x90 .begun_alco_message span.begun_alco_attention {left:10px !important;position:absolute !important;top:10px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_alco_message {padding:10px 10px 12px 20px !important;}#begun_block_{{block_id}} .begun_adv_240x400 .begun_alco_message span.begun_alco_attention {_left:-10px !important;}#begun_block_{{block_id}} .begun_adv_200x300 {width:200px !important;height:300px !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_alco_message {padding:12px 10px 15px 15px !important;}#begun_block_{{block_id}} .begun_adv_200x300 .begun_alco_message span.begun_alco_attention {left:7px !important;_left:-7px !important;top:8px !important;}#begun_block_{{block_id}} .begun_adv_ver .begun_alco_message {padding:10px 7px 10px 7px !important;}#begun_block_{{block_id}} .begun_adv_ver .begun_alco_message span.begun_alco_attention {position:static !important;top:0 !important;left:0 !important;margin-right:5px !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_ver {border-collapse:collapse !important;}#begun_block_{{block_id}} .begun_adv_hor .begun_alco_message {padding:32px 12px 33px 15px !important;width:10% !important;float:right !important;}#begun_block_{{block_id}} .begun_adv_hor .begun_alco_message span.begun_alco_attention {left:7px !important;top:27px !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_hor {border-collapse:collapse !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_hor .begun_adv_common,#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_hor .begun_adv_sys {width:85% !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_hor .begun_adv_cell {padding-right:0 !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_120x600 .begun_adv_common {height:489px !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_alco_message {padding:10px 9px 12px 18px !important;}#begun_block_{{block_id}} .begun_adv_120x600 .begun_alco_message span.begun_alco_attention {left:7px !important;_left:-10px !important;top:7px !important;}#begun_block_{{block_id}} #begun_alco_{{block_id}}.begun_adv_160x600 .begun_adv_common {height:497px !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_alco_message {padding:12px 9px 15px 17px !important;}#begun_block_{{block_id}} .begun_adv_160x600 .begun_alco_message span.begun_alco_attention {left:8px !important;_left:-8px !important;}#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_alco_message {padding:10px 9px 15px 7px !important;}#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_alco_message {border:1px solid {{block:borderColor}} !important;border-top:none !important;}#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_alco_message {border:1px solid {{block_hover:borderColor}} !important;border-top:none !important;}#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_alco_message span.begun_alco_attention {position:static !important;top:0 !important;left:0 !important;margin-right:5px !important;}\
#begun_block_{{block_id}} .begun_adv {\
background-color: {{block:backgroundColor}}; /* no !important for hover */\
border: 1px solid {{block:borderColor}}; /* no !important for hover */\
filter: {{block:filter}}; /* no !important for hover */\
}\
#begun_block_{{block_id}} .begun_adv.begun_hover {\
background-color: {{block_hover:backgroundColor}}; /* no !important for hover */\
border: 1px solid {{block_hover:borderColor}}; /* no !important for hover */\
filter: {{block_hover:filter}}; /* no !important for hover */\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} {\
background: none !important;\
border: none !important;\
filter: none !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_all td {\
padding:5px !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_sys .begun_adv_sys_sign_up {\
padding-right:5px !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_all,\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_sys,\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_common .begun_adv_table td {\
background-color: {{block:backgroundColor}} !important;\
border: 1px solid {{block:borderColor}} !important;\
_filter: {{block:filter}};\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_table {\
_filter: {{block:filter}};\
position:static !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_table td {\
vertical-align:top !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_table td .begun_adv_block {\
position:relative !important;\
z-index:5000000 !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_all *,\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_sys * {\
background-color: {{block:backgroundColor}} !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_all, \
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_sys, \
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_common .begun_adv_table td { \
background-color: {{block_hover:backgroundColor}} !important;\
border: 1px solid {{block_hover:borderColor}} !important;\
_filter: {{block_hover:filter}};\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_table {\
_filter: {{block_hover:filter}};\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_all *,\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_sys * {\
background-color: {{block_hover:backgroundColor}} !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_sys .begun_adv_sys_logo * {\
background-color:transparent !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_all,\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_all {\
width:100% !important;\
border-top:none !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover .begun_adv_sys, \
#begun_block_{{block_id}} #begun_adv_square_{{block_id}} .begun_adv_sys {\
border-bottom:none !important;\
}\
#begun_block_{{block_id}} #begun_adv_square_{{block_id}}.begun_hover {\
border-right:1px solid transparent !important;\
_border-right:none !important;\
}\
#begun_block_{{block_id}} #begun_adv_table_{{block_id}} {\
background-color: {{table:backgroundColor}} !important;\
}\
#begun_block_{{block_id}} .begun_adv.begun_hover #begun_adv_table_{{block_id}} {\
background-color: {{table_hover:backgroundColor}} !important;\
}\
#begun_block_{{block_id}} .begun_adv .begun_thumb img {\
background:{{thumb:backgroundColor}};\ /* no !important for hover */\
}\
#begun_block_{{block_id}} .begun_adv .begun_adv_rich .begun_active_image {\
z-index:1000;\
}\
#begun_block_{{block_id}} .begun_adv .begun_adv_rich .begun_active_image img {\
z-index:1000 !important;\
}\
#begun_block_{{block_id}} .begun_adv .begun_adv_rich .begun_adv_image img {\
border:1px solid #622678;\
position:absolute !important;\
top:0;\
left:0;\
z-index:20;\
cursor:pointer;\
}\
#begun_block_{{block_id}} .begun_adv .begun_adv_rich .begun_adv_picture {\
width:70px;\
height:70px;\
position:absolute !important;\
z-index:20;\
}\
#begun_block_{{block_id}} .begun_adv_accordion.begun_adv_240x400 .begun_adv_common {\
position:relative !important;\
}\
#begun_block_{{block_id}} .begun_adv_accordion .begun_adv_table tr.accordion_section .section {\
padding-top:1px;\
height:1px;\
overflow:hidden;\
position:relative !important;\
}\
#begun_block_{{block_id}} .begun_adv.begun_adv_accordion .begun_adv_common .begun_adv_table tr.accordion_section.expanded td {\
background-color:{{accordion:backgroundColor}} !important;\
}\
#begun_block_{{block_id}} .begun_collapsable {\
width:100%;\
overflow:hidden !important;\
position:fixed;\
top:0;\
left:0;\
_position:absolute;\
_top: expression( ( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + "px" );\
z-index:2147483647;\
border-top:none !important;\
border-left:none !important;\
border-right:none !important;\
}\
#begun_block_{{block_id}} .begun_collapsable .begun_adv_table {\
margin:10px !important;\
}\
#begun_block_{{block_id}} .begun_collapsable .begun_adv_sys_sign_up div {\
margin-left:15px !important;\
margin-right:10px !important;\
}\
#begun_block_{{block_id}} .begun_collapsed {\
height:45px !important;\
overflow:hidden !important;\
}\
#begun_block_{{block_id}} .begun_collapsed .begun_adv_title {\
margin-bottom:30px !important;\
}\
';
			css['forOperaIE'] = '\
#begun_block_{{block_id}} .begun_adv_contact span.begun_adv_phone {\
float:none !important;\
position:static !important;\
vertical-align: top;\
display:inline-block !important;\
}\
#begun_block_{{block_id}} .begun_adv_phone_wrapper {\
padding-left:0 !important;\
position:static !important;\
display:inline !important;\
}\
';
			var html = {};
			html['blck_place'] = '<div id="{{id}}"></div>';
			html['link_iframe'] = '<iframe src="{{url}}" style="height:0;width:0;border:0"></iframe>';
			html['bnnr_glue'] = ' <span class="begun_adv_bullit"> &#149; </span> ';
			html['bnnr_phone'] = '\
<span class="begun_adv_phone"><b class="p0"></b><b class="p1"></b><b class="p2"></b><b class="p4"><b class="p3"></b></b><b class="p5"></b><b class="p6"><b class="p1"></b></b><b class="p7"></b><b class="p8"></b></span>\
';
			html['bnnr_card'] = '\
<span class="begun_adv_phone_wrapper {{no_phone_class}}">{{phone}}<span class="begun_adv_card"><a target="_blank" href="{{url}}" class="snap_noshots">{{card_text}}</a></span></span>\
';
			html['bnnr_ppcall'] = '\
<span class="begun_adv_phone_wrapper">{{phone}}<a href="javascript:void(0)" class="snap_noshots" onclick="showEnterForm({{banner_index}}, this, event, {{pad_id}})"><span class="begun_adv_card">{{ppcall_text}}</span></a></span>\
';
			html['bnnr_domain'] = '\
<span class="begun_adv_contact"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{domain}}</a></span> \
';
			html['bnnr_geo'] = '\
<span class="begun_adv_city"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{geo}}</a></span>\
';
			html['bnnr_thumb'] = '\
<a href="{{url}}" class="begun_thumb snap_noshots" target="_blank"><img src="{{src}}" onmouseover="this.style.background = \'{{bgcolor_hover}}\'" onmouseout="this.style.background = \'{{bgcolor}}\'" {{pngfix}} width="56" height="42" alt=""/></a>\
';
			html['bnnr_picture'] = '\
<div class="begun_adv_image"><a href="{{url}}" class="snap_noshots" target="_blank"><img src="{{src}}" _big_photo_src="{{big_photo_src}}" _small_photo_src="{{src}}" class="begun_adv_picture" alt="" /></a></div>\
';
			html['block_alco'] = '\
<div class="begun_alco_message"><span class="begun_alco_attention">*</span>\
&#1063;&#1088;&#1077;&#1079;&#1084;&#1077;&#1088;&#1085;&#1086;&#1077; &#1091;&#1087;&#1086;&#1090;&#1088;&#1077;&#1073;&#1083;&#1077;&#1085;&#1080;&#1077; &#1072;&#1083;&#1082;&#1086;&#1075;&#1086;&#1083;&#1103; &#1074;&#1088;&#1077;&#1076;&#1080;&#1090; &#1042;&#1072;&#1096;&#1077;&#1084;&#1091; &#1079;&#1076;&#1086;&#1088;&#1086;&#1074;&#1100;&#1102;\
</div>\
';
			html['bnnr_alco_attn'] = '\
<span class="begun_alco_attention">*</span>\
';
			html['banner_square'] = '\
<td class="begun_adv_cell" title="{{fullDomain}}" style="width:{{banner_width}} !important" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{thumb}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}} title="{{fullDomain}}">\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a>{{bnnr_alco}}</div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div>\
</div>\
</td>\
';
			html['banner_vertical'] = '\
<tr>\
<td class="begun_adv_cell" title="{{fullDomain}}" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{thumb}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}} title="{{fullDomain}}">\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a>{{bnnr_alco}}</div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div>\
</div>\
</td>\
</tr>\
';
			html['banner_flat'] = '\
<tr>\
<td class="begun_adv_cell" title="{{fullDomain}}" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{thumb}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}} title="{{fullDomain}}">\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a></div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
</div>\
</td>\
</tr>\
';
			html['banner_240x400_use_accordion'] = '\
<tr class="accordion_section">\
<td class="begun_adv_cell" title="{{fullDomain}}" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{thumb}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}} title="{{fullDomain}}">\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a></div>\
<div class="section"><div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div></div>\
</div>\
</td>\
</tr>\
';
			html['banner_200x300_use_accordion'] = html['banner_240x400_use_accordion'];
			html['banner_rich'] = '\
<tr>\
<td class="begun_adv_cell begun_adv_rich" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{picture}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}} title="{{fullDomain}}">\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a></div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div>\
</div>\
</td>\
</tr>\
';
			html['banner_horizontal_rich'] = '\
<td class="begun_adv_cell begun_adv_rich" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{picture}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}} title="{{fullDomain}}">\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a></div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div>\
</div>\
</td>\
';
			html['banner_vertical_rich']  = html['banner_rich_rich'] = html['banner_240x400_rich'] = html['banner_120x600_rich'] = html['banner_160x600_rich'] = html['banner_rich'];
			html['banner_728x90_rich'] = html['banner_horizontal_rich'];
			html['banner_200x300'] = html['banner_240x400'] = html['banner_120x600'] = html['banner_160x600'] = html['banner_vertical'];
			html['banner_horizontal'] = '\
<td class="begun_adv_cell" style="width:{{banner_width}} !important" title="{{fullDomain}}" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
{{thumb}}\
<div class="begun_adv_block {{css_favicon}}" {{favicon}}>\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}" {{favicon}}>{{title}}</a>{{bnnr_alco}}</div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div>\
</div>\
</td>\
';
			html['banner_top'] = '\
<td class="begun_adv_cell" style="width:{{banner_width}} !important" title="{{fullDomain}}" onclick="{{onclick}}" _url="{{url}}" _banner_id="{{banner_id}}">\
<div class="begun_adv_block {{css_favicon}}" {{favicon}}>\
<div class="begun_adv_title"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{title}}</a></div>\
<div class="begun_adv_text"><a class="snap_noshots" target="_blank" href="{{url}}" onmouseover="status=\'{{status}}\';return true" onmouseout="status=\'\';return true" title="{{fullDomain}}">{{descr}}</a></div>\
<div class="begun_adv_contact">{{contact}}</div>\
</div>\
</td>\
';
			html['banner_468x60'] = html['banner_728x90'] = html['banner_horizontal'];
			html['blck_hover'] = ' onmouseover="Begun.Utils.addClassName(this, \'begun_hover\');" onmouseout="Begun.Utils.removeClassName(this, \'begun_hover\');"';
			html['block_vertical'] = '\
<table id="{{begun_alco_id}}" class="begun_adv begun_adv_ext begun_adv_ver banners_count_{{banners_count}}"{{block_hover}} style="width:{{block_width}}">\
<tr>\
<td class="begun_adv_cell">\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<div class="begun_adv_all" style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div>\
{{block_alco}}\
</td>\
</tr>\
</table>\
';
			html['block_square'] = '\
<table id="begun_adv_square_{{block_id}}" class="begun_adv begun_adv_ext begun_adv_square {{begun_alco_id}} banners_count_{{banners_count}}"{{block_hover}} style="width:{{block_width}}">\
<tr>\
<td class="begun_adv_cell">\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<table class="begun_adv_all" style="display:{{all_banners_display}}"><tr><td><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></td></tr></table>\
{{block_alco}}\
</td>\
</tr>\
</table>\
';
			html['block_flat'] = '\
<table class="begun_adv begun_adv_ext begun_adv_flat"{{block_hover}}>\
<tr>\
<td class="begun_adv_cell">\
<div class="begun_adv_common {{block_scroll_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
</td>\
</tr>\
</table>\
';
			html['block_horizontal'] = '\
<table id="{{begun_alco_id}}" class="begun_adv begun_adv_ext begun_adv_hor"{{block_hover}} style="width:{{block_width}}">\
<tr>\
<td class="begun_adv_cell">\
{{block_alco}}\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" colspan="{{begun_url_colspan}}"><div style="display:{{logo_display}}"><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up"><div style="display:{{become_partner_display}}"><a href="{{become_partner_url}}" target="_blank" class="snap_noshots">{{become_partner_text}}</a></div></td>\
<td class="begun_adv_sys_sign_up"><div style="display:{{place_here_display}}"><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
<td class="begun_adv_sys_sign_up"><div style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
<tr>\
{{banners}}\
</tr>\
</table>\
</div>\
</td>\
</tr>\
</table>\
';
			html['block_top'] = '\
<div class="begun_adv begun_adv_ext begun_collapsable begun_collapsed"{{block_hover}} style="width:{{block_width}}">\
<div class="begun_adv_common {{block_scroll_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
<tr>\
{{banners}}\
</tr>\
</table>\
</div>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" colspan="{{begun_url_colspan}}" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{become_partner_display}}"><div><a href="{{become_partner_url}}" target="_blank" class="snap_noshots">{{become_partner_text}}</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{all_banners_display}}"><div><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div></td>\
</tr></table>\
</div>\
';
			html['block_468x60'] = '\
<div class="begun_adv begun_adv_fix begun_adv_fix_hor begun_adv_468x60"{{block_hover}}>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}}" id="{{scroll_div_id}}">\
<div class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></div>\
<div class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></div>\
<table class="begun_adv_table {{css_thumbnails}} {{extended_block_class}}" id="{{scroll_table_id}}">\
<tr>\
{{banners}}\
</tr>\
</table>\
</div>\
</div>\
';
			html['block_728x90'] = '\
<div id="{{begun_alco_id}}" class="begun_adv begun_adv_fix begun_adv_fix_hor begun_adv_728x90"{{block_hover}}>\
{{block_alco}}\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}}" id="{{scroll_div_id}}">\
<div class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></div>\
<div class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></div>\
<table class="begun_adv_table {{css_thumbnails}} {{extended_block_class}}" id="{{scroll_table_id}}">\
<tr>\
{{banners}}\
</tr>\
</table>\
</div>\
</div>\
';
			html['block_200x300'] = '\
<div id="{{begun_alco_id}}" class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_200x300"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
{{block_alco}}\
</div>\
';
			html['block_200x300_use_accordion'] = '\
<div class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_200x300 begun_adv_accordion"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
</div>\
';
			html['block_240x400'] = '\
<div id="{{begun_alco_id}}" class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_240x400"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<div class="begun_adv_all" style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div>\
{{block_alco}}\
</div>\
';
			html['block_240x400_use_accordion'] = '\
<div class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_240x400 begun_adv_accordion"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<div class="begun_adv_all" style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div>\
</div>\
';
			html['block_rich'] = '\
<div class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_240x400"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<div class="begun_adv_all" style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div>\
</div>\
';
			html['block_120x600'] = '\
<div id="{{begun_alco_id}}" class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_120x600"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<div class="begun_adv_all" style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div>\
{{block_alco}}\
</div>\
';
			html['block_160x600'] = '\
<div id="{{begun_alco_id}}" class="begun_adv begun_adv_fix begun_adv_fix_ver begun_adv_160x600"{{block_hover}}>\
<table class="begun_adv_sys"><tr>\
<td class="begun_adv_sys_logo" style="display:{{logo_display}}"><div><a href="{{begun_url}}" target="_blank" class="snap_noshots">begun</a></div></td>\
<td class="begun_adv_sys_sign_up" style="display:{{place_here_display}}"><div><a href="{{place_here_url}}" target="_blank" class="snap_noshots">{{place_here_text}}</a></div></td>\
</tr></table>\
<div class="begun_adv_common {{block_scroll_class}} banners_count_{{banners_count}} {{extended_block_class}}" id="{{scroll_div_id}}">\
<table class="begun_adv_table {{css_thumbnails}}" id="{{scroll_table_id}}">\
{{banners}}\
</table>\
</div>\
<div class="begun_adv_all" style="display:{{all_banners_display}}"><a href="{{all_banners_url}}" target="_blank" class="snap_noshots">{{all_banners_text}}</a></div>\
{{block_alco}}\
</div>\
';
			html['top_graph_banner'] = '<table id="begun_top_graph_banner"><tbody><tr><td class="begun_top_graph_banner_left_col"></td><td>{{html}}</td><td class="begun_top_graph_banner_right_col"></td></tr></tbody></table>';
			html['search_banner_swf'] = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{{width}}" height="{{height}}"><param name="movie" VALUE="{{source}}&link1={{url}}"><param name="wmode" value="opaque"><param name="allowScriptAccess" value="always"><param name="quality" VALUE="high"><embed src="{{source}}&link1={{url}}" quality="high" width="{{width}}" height="{{height}}" type="application/x-shockwave-flash" wmode="opaque"></embed></object>';
			html['search_banner_js'] = '';
			html['search_banner_img'] = '<a href="{{url}}" target="_blank"><img src="{{source}}&redir=1" border="0" width="{{width}}" height="{{height}}" /></a>';
	
			this.getCSS = function(type){
				return css[type];
			};
			this.getHTML = function(type){
				return html[type];
			};
			this.addTpls = function(){
				var types = ['html', 'css'];
				var i = 0;
				var type = null;
				var is_default_css_override = false;
				if (css['default'] && window['begun_css_tpls'] && window['begun_css_tpls']['default'] && css['default'] != window['begun_css_tpls']['default']){
					is_default_css_override  = true;
				}
				while (type = types[i]){
					if (window['begun_' + type + '_tpls'] !== undefined){
						var j = 0;
						var tpl = null;
						while (tpl = window['begun_' + type + '_tpls'][j]){
							Begun.extend(eval(type), tpl);
							j++;
						}
					}
					i++;
				}
				return is_default_css_override;
			};
		};

		ac.Customization = new function(){
			var _this = this;
			this.init = function(){
				if (window.begun_urls !== undefined){
					_this.setURLs(window.begun_urls);
					window.begun_urls = null;
				}
				if (window.begun_callbacks !== undefined){
					_this.setCallbacks(window.begun_callbacks);
					window.begun_callbacks = null;
				}
				if (_this.setTpls() || !arguments.callee.run){
					ac.printDefaultStyle();
					arguments.callee.run = true;
					/*window.begun_html_tpls = null;
					window.begun_css_tpls = null;*/
				}
			};
			this.setURLs = function(urls){
				Begun.extend(ac.Strings.urls, urls || {});
			};
			this.setCallbacks = function(callbacks){
				ac.Callbacks.register(callbacks || {});
			};
			this.setTpls = function(){
				ac.Tpls.addTpls();
			};
		};
	})();

	(function(){
		var ac = Begun.Autocontext;

		if (typeof onContent != 'function'){
			function onContent(f){
				var a, d = document, w = window, c = "__onContent__", e = "addEventListener", o = "opera", r = "readyState",
				s = "<scr".concat("ipt defer src='//:' on", r, "change='if (this.", r, "==\"complete\"){this.parentNode.removeChild(this);", c, "()}'></scr","ipt>");
				w[c] = (function(o){
					return function(){
						w[c]=function(){};
						for (a = arguments.callee; !a.done; a.done = 1){
							f(o ? o() : o);
						}
					};
				})(w[c]);
				if (d[e]){
					d[e]("DOMContentLoaded", w[c], false);
				}
				var bb = Begun.Browser;
				if ((bb.WebKit) || (bb.Opera && bb.less(9))){
					(function(){
						/loaded|complete/.test(d[r]) ? w[c]() : setTimeout(arguments.callee, 1);
					})();
				} else if (bb.IE){
					d.write(s);
				}
			}
		}
	
		onContent(function(){
			ac.Callbacks.dispatch('blocks', 'draw', ac);
		});

		ac.Monitor.init();
	})();
	Begun.Autocontext.init();
	}
}

if (typeof Begun.Autocontext === "object") {
	Begun.Autocontext.init();
}

Begun.Scripts.addStrictFunction(Begun.Scripts.Callbacks['ac']);
}
