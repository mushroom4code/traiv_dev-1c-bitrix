<?namespace Intervolga\Tips;

/**
 * Checks user rights for module.
 *
 * @package Intervolga\Tips
 */
class Rights
{
	/**
	 * Checks whether user can see tips in panel or admin section.
	 *
	 * @return bool
	 */
	public static function canRead()
	{
		global $APPLICATION;
		return $APPLICATION->GetGroupRight("intervolga.tips") >= "R";
	}

	/**
	 * Checks whether user can add, update and delete tips in panel or admin section.
	 *
	 * @return bool
	 */
	public static function canWrite()
	{
		global $APPLICATION;
		return $APPLICATION->GetGroupRight("intervolga.tips") >= "W";
	}
}