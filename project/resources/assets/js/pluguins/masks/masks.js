import MaskBehaviors from './masks-behaviors'
import './mask-money.min'

$(function() {
    $('.mask-cellphone').mask(MaskBehaviors.nineDigitsBehavior, MaskBehaviors.nineDigitsOptions)
    $('.mask-phone').mask(MaskBehaviors.nineDigitsBehavior, MaskBehaviors.nineDigitsOptions)

    $('.mask-money').maskMoney({decimal: ",", thousands: "."})
    $('.mask-quantity').mask('#,000', { reverse: true })
    $('.mask-cep').mask('00000-000', { clearIfNotMatch: true, placeholder: '00000-000' })
    $('.mask-cpf').mask('000.000.000-00', { reverse: false, clearIfNotMatch: true, placeholder: '000.000.000-00' })
    $('.mask-rg').mask('99.999.999-9', { reverse: false, clearIfNotMatch: true, placeholder: '00.000.000-0' })
    $('.mask-cnpj').mask('00.000.000/0000-00', { reverse: false, clearIfNotMatch: true, placeholder: '00.000.000/0000-00' })
    $('.mask-date').mask('00/00/0000', { clearIfNotMatch: true, placeholder: '00/00/0000' })
    $('.mask-datetime').mask('00/00/0000 00:00', { clearIfNotMatch: true, placeholder: '00/00/0000 00:00' })

    $('.mask-integer').mask('0000000000')
})
