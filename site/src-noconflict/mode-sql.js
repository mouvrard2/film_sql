ace.define("ace/mode/sql_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"], function(require, exports, module) {
"use strict";

var oop = require("../lib/oop");
var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;

var SqlHighlightRules = function() {
	var tables =( // modif  martial
	"film|acteur|jouer|realisateur|genre|"+
	"visages|position_visage|monstre|corps|oreilles|cornes|position_oreilles|position_cornes"
	);
	var champs =( // modif  martial
	"id_film|titre|annee|id_genre|libelle|id_rea|nom|prenom|age|id_act|role|id_acteur|"+
	"id_visage|nom_monstre|id_visages|id_corps|id_oreilles|id_cornes|"+
	"id_im_visage|nom_visages|ad_visages|nb_yeux|couleur_yeux|"+
	"id_im_corps|nom_corps|ad_corps|"+
	"id_type_oreilles|id_im_oreilles|nom_oreilles|ad_oreilles|"+
	"id_im_cornes|nom_cornes|ad_cornes|"+
	"id_position_cornes|id_type_corps|dev_der|id_cornes|cornes_pos_x|cornes_pos_y|"+
	"id_position_visage|id_visage|visage_pos_x|visage_pos_y|"+
	"id_position_oreilles|oreilles_pos_x|oreilles_pos_y"
	);
    var keywords = (
        "select|insert|update|delete|from|where|and|or|group|by|order|limit|offset|having|as|case|into|values|" +
        "when|then|else|end|type|left|right|join|on|outer|desc|asc|union|create|table|primary|key|if|" +
        "foreign|not|references|default|null|inner|cross|natural|database|drop|grant"
    );

    var builtinConstants = (
        "true|false"
    ); 

    var builtinFunctions = (
        "avg|count|first|last|max|min|sum|ucase|lcase|mid|len|round|rank|now|format|" + 
        "coalesce|ifnull|isnull|nvl"
    );

    var dataTypes = (
        "int|numeric|decimal|date|varchar|char|bigint|float|double|bit|binary|text|set|timestamp|" +
        "money|real|number|integer"
    );

    var keywordMapper = this.createKeywordMapper({
        "support.function": builtinFunctions,
        "keyword": keywords,
		"table": tables, // martial -> voir modif sur  ace.js ".ace_table {\color: #2Df011\}" et theme-??.js ".ace_table {\color: #2Df011\}"
        "champ": champs, // martial
		"constant.language": builtinConstants,
        "storage.type": dataTypes
    }, "identifier", true);

    this.$rules = {
        "start" : [ {
            token : "comment",
            regex : "--.*$"
        },  {
            token : "comment",
            start : "/\\*",
            end : "\\*/"
        }, {
            token : "string",           // " string
            regex : '".*?"'
        }, {
            token : "string",           // ' string
            regex : "'.*?'"
        }, {
            token : "string",           // ` string (apache drill)
            regex : "`.*?`"
        }, {
            token : "constant.numeric", // float
            regex : "[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"
        }, {
            token : keywordMapper,
            regex : "[a-zA-Z_$][a-zA-Z0-9_$]*\\b"
        }, {
            token : "keyword.operator",
            regex : "\\+|\\-|\\/|\\/\\/|%|<@>|@>|<@|&|\\^|~|<|>|<=|=>|==|!=|<>|="
        }, {
            token : "paren.lparen",
            regex : "[\\(]"
        }, {
            token : "paren.rparen",
            regex : "[\\)]"
        }, {
            token : "text",
            regex : "\\s+"
        } ]
    };
    this.normalizeRules();
};

oop.inherits(SqlHighlightRules, TextHighlightRules);

exports.SqlHighlightRules = SqlHighlightRules;
});

ace.define("ace/mode/sql",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/sql_highlight_rules"], function(require, exports, module) {
"use strict";

var oop = require("../lib/oop");
var TextMode = require("./text").Mode;
var SqlHighlightRules = require("./sql_highlight_rules").SqlHighlightRules;

var Mode = function() {
    this.HighlightRules = SqlHighlightRules;
    this.$behaviour = this.$defaultBehaviour;
};
oop.inherits(Mode, TextMode);

(function() {

    this.lineCommentStart = "--";

    this.$id = "ace/mode/sql";
    this.snippetFileId = "ace/snippets/sql";
}).call(Mode.prototype);

exports.Mode = Mode;

});                (function() {
                    ace.require(["ace/mode/sql"], function(m) {
                        if (typeof module == "object" && typeof exports == "object" && module) {
                            module.exports = m;
                        }
                    });
                })();
            