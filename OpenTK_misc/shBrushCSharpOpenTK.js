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
		var keywords =	'abstract as base bool break byte case catch char checked class const ' +
						'continue decimal default delegate do double else enum event explicit ' +
						'extern false finally fixed float for foreach get goto if implicit in int ' +
						'interface internal is lock long namespace new null object operator out ' +
						'override params private protected public readonly ref return sbyte sealed set ' +
						'short sizeof stackalloc static string struct switch this throw true try ' +
						'typeof uint ulong unchecked unsafe ushort using virtual void while';

		function fixComments(match, regexInfo)
		{
			var css = (match[0].indexOf("///") == 0)
				? 'color1'
				: 'comments'
				;
			
			return [new SyntaxHighlighter.Match(match[0], match.index, css)];
		}

		this.regexList = [
			{ regex: SyntaxHighlighter.regexLib.singleLineCComments,	func : fixComments },		// one line comments
			{ regex: SyntaxHighlighter.regexLib.multiLineCComments,		css: 'comments' },			// multiline comments
			{ regex: /@"(?:[^"]|"")*"/g,								css: 'string' },			// @-quoted strings
			{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },			// strings
			{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },			// strings
			{ regex: /^\s*#.*/gm,										css: 'preprocessor' },		// preprocessor tags like #region and #endregion
			{ regex: new RegExp(this.getKeywords(keywords), 'gm'),		css: 'keyword' },			// c# keyword
			{ regex: /\bpartial(?=\s+(?:class|interface|struct)\b)/g,	css: 'keyword' },			// contextual keyword: 'partial'
			{ regex: /\byield(?=\s+(?:return|break)\b)/g,				css: 'keyword' },			// contextual keyword: 'yield'
			{ regex: new RegExp(OpenTKClassRegExp(),'g'),				css: 'OpenTKclass' },		// OpenTK classes
			{ regex: new RegExp(OpenTKEnumRegExp(),'g'),				css: 'OpenTKenum'}
			];
		
		this.forHtmlScript(SyntaxHighlighter.regexLib.aspScriptTags);
	};

	Brush.prototype	= new SyntaxHighlighter.Highlighter();
	Brush.aliases	= ['c#', 'c-sharp', 'csharp'];

	SyntaxHighlighter.brushes.CSharp = Brush;

	// CommonJS
	typeof(exports) != 'undefined' ? exports.Brush = Brush : null;
})();

function OpenTKClassRegExp()
{
	var classes=[
		"[\\s\\(]GL(?=\\.)", "^GL(?=\\.)",
		"Vector\\d",
		"Color\\d(?=\\..+\\))", " Color\\d(?=[\\.\\(\\[])", "Color\\d ", "Color\\d(?=\\))",
		"Matrix\\d",
		"MathHelper(?=\\.)",
		"Quaternion",
		"GraphicsMode",
		"Joystick"
	];
	
	return classes.join('|');
}

function OpenTKEnumRegExp()
{
	var enums=[
		"EnableCap",
		"MatrixMode",
		"ClearBufferMask",
		"BeginMode",
		"ArrayCap",
		"BufferTarget",
		"BufferUsageHint",
		"VertexPointerType",
		"CullFaceMode",
		"FrontFaceDirection",
		"LightName",
		"LightParameter",
		"MaterialFace",
		"MaterialParameter",
		"ColorMaterialParameter",
		"NormalPointerType",
		"ColorPointerType",
		"DrawElementsType",
		"BlendingFactorSrc",
		"BlendingFactorDest",
		"BlendEquationMode",
		"FogParameter",
		"FogMode",
		"HintTarget",
		"HintMode",
		"DepthFunction",
		"AlphaFunction",
		"StencilOp",
		"StencilFunction",
		"TextureTarget",
		"TextureParameterName",
		"TextureMinFilter",
		"TextureMagFilter",
		"PixelInternalFormat",
		"PixelFormat",
		"PixelType",
		"TextureWrapMode",
		"TextureEnvTarget",
		"TextureEnvParameter",
		"TextureEnvMode",
		"TextureUnit",
		"TextureEnvModeCombine",
		"TextureEnvModeSource",
		"TextureEnvModeOperandRgb",
		"TextureEnvModeOperandAlpha",
		"TexCoordPointerType",
		"ShaderType",
		"ShaderParameter",
		"ProgramParameter",
		"JoystickButton",
		"ButtonState",
		"JoystickHat",
		"HatPosition",
		"JoystickAxis"
	];
	
	for(var i=0;i<enums.length;i++)
	{
		enums[i]+="(?=\\.)";
	}
	
	return enums.join('|');
}