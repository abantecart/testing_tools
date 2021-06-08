import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject
import com.kms.katalon.core.checkpoint.Checkpoint as Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling as FailureHandling
import com.kms.katalon.core.testcase.TestCase as TestCase
import com.kms.katalon.core.testdata.TestData as TestData
import com.kms.katalon.core.testng.keyword.TestNGBuiltinKeywords as TestNGKW
import com.kms.katalon.core.testobject.TestObject as TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows
import internal.GlobalVariable as GlobalVariable
import org.openqa.selenium.Keys as Keys
import com.kms.katalon.core.testobject.ConditionType

WebUI.openBrowser('')

WebUI.navigateToUrl(GlobalVariable.StoreURLDefault+GlobalVariable.AdminURL)

WebUI.setText(findTestObject('0AdminTest-1/1-CategoryCreate/Page_Administration/input_Please enter your login details_username'),
    GlobalVariable.defaultAdminUsername)

WebUI.setEncryptedText(findTestObject('0AdminTest-1/1-CategoryCreate/Page_Administration/input_Please enter your login details_password'),
    'PblvLzUlPsM=')

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Administration/button_Login'))

WebUI.click(findTestObject('0AdminTest-1/3-CreateBrand/Page_Dashboard/h5_Brands'))

WebUI.setText(findTestObject('Object Repository/4-removeBrand/Page_Brands/input_Action_name'), 'new')

WebUI.sendKeys(findTestObject('Object Repository/4-removeBrand/Page_Brands/input_Action_name'), Keys.chord(Keys.ENTER))

WebUI.delay(1)

//WebUI.click(findTestObject('Object Repository/4-removeBrand/Page_Brands/i_Action_fa fa-trash-o fa-lg'))

//WebUI.click(findTestObject('Object Repository/4-removeBrand/Page_Brands/a_Delete'))


TestObject brandRemoveButton = new TestObject().addProperty('css', ConditionType.EQUALS, 'a.btn.btn-xs.btn_grid.tooltips.grid_action_delete')

WebUI.click(brandRemoveButton)



TestObject GridConfirmButton = new TestObject().addProperty('css', ConditionType.EQUALS, 'a#dData')

WebUI.click(GridConfirmButton)
WebUI.delay(1)


WebUI.verifyElementText(findTestObject('Object Repository/4-removeBrand/Page_Brands/div_No result found'), 'No result found.')





//load grid again
TestObject BrandLink = new TestObject().addProperty('css', ConditionType.EQUALS, '#menu_manufacturer > a')

WebUI.click(BrandLink)

WebUI.setText(findTestObject('Object Repository/4-removeBrand/Page_Brands/input_Action_name'), 'new')

WebUI.sendKeys(findTestObject('Object Repository/4-removeBrand/Page_Brands/input_Action_name'), Keys.chord(Keys.ENTER))

WebUI.delay(1)

WebUI.verifyElementText(findTestObject('Object Repository/4-removeBrand/Page_Brands/div_No result found'), 'No result found.')

WebUI.closeBrowser()
