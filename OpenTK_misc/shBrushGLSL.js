/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/SyntaxHighlighter
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/SyntaxHighlighter/donate.html
 *
 * @version
 * 3.0.83 (July 02 2010)
 * 
 * @copyright
 * Copyright (C) 2004-2010 Alex Gorbatchev.
 *
 * @license
 * Dual licensed under the MIT and GPL licenses.
 */
;(function()
{
	// CommonJS
	typeof(require) != 'undefined' ? SyntaxHighlighter = require('shCore').SyntaxHighlighter : null;

	function Brush()
	{
		// Copyright 2006 MasuqaT

		var dataTypes = 'void bool int uint float double ' +
						'vec2 vec3 vec4 mat2 mat3 mat4 mat2x2 mat2x3 mat2x4 mat3x2 mat3x3 mat3x4 mat4x2 mat4x3 mat4x4 ' +
						'' +
						'bvec2 bvec4 ';
		
		var keywords = 'true false const struct return in out inout ';

		var intrinsic = 'ftransform ' +
						'radians degrees sin cos tan asin acos atan sinh cosh tanh asinh acosh atanh ' +
						'pow exp log exp2 log2 sqrt inversesqrt ' +
						'floor ceil trunc round roundEven fract mod modf abs sign min max clamp mix step smoothstep isnan isinf ' +
						'length distance dot cross normalize faceforward reflect refract ' +
						'matrixCompMult outerProduct transpose determinant inverse ' +
						'lessThan lessThanEqual greaterThan greaterThanEqual equal notEqual any all not ';

		var embedVariables = 'gl_Position gl_FragColor';

		this.regexList = [
			{ regex: /([^a-zA-Z\(,\[](\d+\.?(\d+)?|\.\d+))|(\d+\.?(\d+)?|\.\d+)(?=\s*\])/gm, css: 'GLSLnumber'},
			{ regex: SyntaxHighlighter.regexLib.singleLineCComments,	css: 'comments' },			// one line comments
			{ regex: SyntaxHighlighter.regexLib.multiLineCComments,		css: 'comments' },			// multiline comments
			{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'GLSLstring' },
			//{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },
			{ regex: /^\s*#[^\s\d"]*/gm, css: 'GLSLpreprocessor' },
			{ regex: new RegExp(this.getKeywords(dataTypes), 'gm'),     css: 'keyword'},
			{ regex: new RegExp(this.getKeywords(keywords), 'gm'),     css: 'keyword'},
			{ regex: new RegExp(this.getKeywords(intrinsic), 'gm'),     css: 'GLSLintrinsic' },
			{ regex: new RegExp(this.getKeywords(embedVariables), 'gm'),css: 'GLSLspecial'}
			];
	};

	Brush.prototype	= new SyntaxHighlighter.Highlighter();
	Brush.aliases	= ['glsl'];

	SyntaxHighlighter.brushes.Cpp = Brush;

	// CommonJS
	typeof(exports) != 'undefined' ? exports.Brush = Brush : null;
})();
